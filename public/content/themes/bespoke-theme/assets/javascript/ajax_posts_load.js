window.isEqual = function (test1, test2) {
  if(test1 == test2)
  {
    return true;
  }

  if(typeof test1 != typeof test2)
  {
    return false;
  }

  if(typeof test1 == typeof {} && test1 && test2)
  {
    var keys = Object.keys(test1);

    if(keys.length != Object.keys(test2).length)
    {
      return false;
    }

    for(var n = 0; n < keys.length; n ++)
    {
      if(!isEqual(test1[keys[n]], test2[keys[n]]))
      {
        return false;
      }
    }

    return true;
  }

  return false;
};


window.object_contains = function (subject, test) {
  if(test == subject)
  {
    return true;
  }

  if(typeof test != typeof subject)
  {
    return false;
  }

  if(typeof test == typeof {} && test && subject)
  {
    var keys = Object.keys(test);

    for(var n = 0; n < keys.length; n ++)
    {
      if(
        !(
          subject[keys[n]] instanceof Object && object_contains(subject[keys[n]], test[keys[n]])
        ) &&
        !isEqual(subject[keys[n]], test[keys[n]])
      )
      {
        return false;
      }
    }

    return true;
  }

  return false;
};

window.object_extract = function (subject, test) {
  if(test == subject)
  {
    return {};
  }

  if(typeof test != typeof subject)
  {
    return subject;
  }

  if(typeof test == typeof {} && test && subject)
  {
    var keys = Object.keys(test);

    for(var n = 0; n < keys.length; n ++)
    {
      if(
        subject[keys[n]] instanceof Object &&
        test[keys[n]] instanceof Object &&
        test[keys[n]].length > 0
      )
      {
        object_extract(subject[keys[n]], test[keys[n]])
      }
      else
      {
        delete subject[keys[n]];
      }
    }

  }

  return subject;
};

$.fn.serializeObject = function () {
  var object = {},
      array = this.serializeArray();

  for(var i = 0; i < array.length; i++)
  {
    var input = array[i],
        pointers = input.name.match(/(\[?[^\[\]]+\]?|\[\])/g),
        focus = object;

    for(var j = 0; j < pointers.length; j++)
    {
      var match = pointers[j].match(/[^\[\]]+/),
          pointer = match ? match[0] : null,

          value = j == pointers.length - 1 ? input.value : (pointers[j + 1] == "[]" ? [] : {});

      if(match == null)
      {
        focus.push(value);
      }
      else
      if(focus[pointer] === undefined || typeof value != 'object' || value.constructor.name != focus[pointer].constructor.name)
      {
        focus[pointer] = value;
      }

      focus = focus[pointer];
    }
  }

  return object;
};

function update_active_queries()
{
  var query = $(this).data('query');

  $(this).find('[data-query]').each(function () {
    $(this).toggleClass('query-active', object_contains(query, $(this).data('query')));
  });
}

function ajax_posts_load(newQuery, extract)
{
  var $parent = $(this).parents('.ajax-posts-load:first');

  $parent.data('query') || $parent.data('query', {});

  return new Promise(function (done) {
    var url = $parent.data('ajax'),
        query = $parent.data('query'),
        old,
        paged;

    delete query.paged;

    old = Object.assign({}, query);


    query = extract && object_contains(query, newQuery) ? object_extract(query, newQuery) : $.extend(query, newQuery || {});

    if(isEqual(old, query))
    {
      done();
      return;
    }

    $parent.each(update_active_queries);

    paged = query.paged || 1;

    $.get(url + '&' + $.param(query)).then(function (html) {
      delete query.paged;

      var load_more = isEqual(old, query);
      var load_more_query = Object.assign({}, query);

      if(load_more)
      {
        load_more_query.paged = paged + 1;
        $parent.find('.ajax-posts .ajax-load-more-container').remove();
        $parent.find('.ajax-posts').append(html);
      }
      else
      {
        load_more_query.paged = 2;
        $parent.find('.ajax-posts').html(html);
      }

      $parent.find('.ajax-load-more').data('query', load_more_query);

      done();
    });

    $parent.data('query', query);
  });
}

$(document).on('click', '.ajax-posts-load a[data-query]', function () {
  var $this = $(this),
      content = $this.html();

  $this.css('width', $this[0].clientWidth);
  $this.html('<i class="fa fa-spin fa-refresh" />');

  ajax_posts_load.call(this, $this.data('query'), true)
    .then(function () {

      $this.css('width', '');
      $this.html(content);
    });

});

var $submit_button = $([]);

$(document).on('focus', '.ajax-posts-load .ajax-posts-form button', function () {
  $submit_button = $(this);
});

$(document).on('submit', '.ajax-posts-load .ajax-posts-form', function (event) {
  event.preventDefault();

  if($submit_button.length <= 0 && event.originalEvent && event.originalEvent.submitter)
  {
    $submit_button = $(event.originalEvent.submitter);
  }

  var content = $submit_button.html();

  $submit_button.css('width', $submit_button.length > 0 && $submit_button[0].clientWidth);
  $submit_button.html('<i class="fa fa-spin fa-refresh" />');

  ajax_posts_load.call(this, $(this).serializeObject())
    .then(function () {

      $submit_button.css('width', '');
      $submit_button.html(content);
    });

  return false;
});
