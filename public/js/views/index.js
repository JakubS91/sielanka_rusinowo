(function() {
  "use strict";
  APP.Views.Index = Backbone.View.extend({
    events: {
    },
    initialize: function(options) {
    },
    render: function() {
      this.$el.html(_.template($('#indexTemplate').html(), {}));
      return this;
    }
  });
}());