window.APP = window.APP || {
  Routers: {},
  Views: {}
};
(function() {
  "use strict";
  APP.Routers.MainRouter = Backbone.Router.extend({
    routes: {
      "": "index"
    },
    initialize: function () {
      Backbone.history.start();
    },
    index: function() {
      $('#content').html(new APP.Views.Index().render().el);
    }
  });
}());