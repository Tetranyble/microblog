// Generated by CoffeeScript 1.4.0
(function() {
  var app;

  app = angular.module('main', []);

  app.controller('MainCtrl', function($scope) {
    $scope.posts = [
      {
        'user': 'U1',
        'content': 'loloolol',
        'timestamp': 1400100000000
      }
    ];
    return $scope.create = function(post) {
      $scope.posts.push({
        'user': 'U1',
        'content': post.content,
        'timestamp': Date.now()
      });
      return post.content = '';
    };
  });

}).call(this);