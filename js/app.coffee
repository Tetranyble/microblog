app = angular.module('main', [])

app.controller 'MainCtrl', ($scope, $http) ->
  $scope.posts = [{}]

  $http.get('someUrl.html').then (response) ->
    $scope.posts = response.data

  $scope.create = (post) ->
    $http.post('someUrl.html', JSON.stringify({'user': this.userName, 'content': post.content})).then (response) ->
      $scope.posts.push response.data
      post.content = ''

  $scope.signedOut = false;
  $scope.userName = ''
