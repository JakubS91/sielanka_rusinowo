function BeClient() {
  this.defualtOptions = {
    preloaderShow: true,
    preloaderHide: true
  },
  this.invoke = function(method, params, callback, options) {
    if (typeof options == "undefined")
      var options = {};
    options = $.extend({}, this.defualtOptions, options);
    $.ajax({
      type: 'POST',
      url: ADDRESS_BE + method,
      cache: false,
      data: {params: params},
      dataType: "json",
      async: true,
      timeout: 20000,
      beforeSend: function () {
        if (options.preloaderShow) {
        }
      },
      success: function(data) {
        
      },
      error: function() {
        
      }
    });
  },
  this.getApp = function() {
    var u = new Object();
    return u;
  },
  this.login = function(login, password, callback, options) {
    var u = new Object();
    u.app = this.getApp();
    u.login = login;
    u.password = password;
    return this.invoke('login', u);
  }
}