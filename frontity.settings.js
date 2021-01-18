const settings = {
  "name": "frontity-test",
  "state": {
    "frontity": {
      "url": "https://test.frontity.org",
      "title": "ZR",
      "description": "Hello"
    }
  },
  "packages": [
    {
      "name": "@frontity/mars-theme",
      "state": {
        "theme": {
          "menu": [
            [
              "Home",
              "/"
            ],
            [
              "Projects",
              "/projects/"
            ],
            [
              "About",
              "/about"
            ],
          ],
          "featured": {
            "showOnList": false,
            "showOnPost": false
          }
        }
      }
    },
    {
      "name": "@frontity/wp-source",
      postTypes: [
        {
          type: "project",
          endpoint: "project",
          archive: "/project_archive",
        },
      ],
      "state": {
        "source": {
          "url": "https://zr-staxo.staxoweb.net"
        }
      }
    },
    "@frontity/tiny-router",
    "@frontity/html2react"
  ]
};

export default settings;
