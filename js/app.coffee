app = angular.module('main', [])

app.controller 'MainCtrl', ($scope, $http) ->
  $scope.posts = [{}]

  $http.get('/posts').then (response) ->
    $scope.posts = response.data

  $scope.create = (post) ->
    $http.post('/post', JSON.stringify({'p_user': this.userName, 'content': post.content})).then (response) ->
      $scope.posts.push response.data
      post.content = ''

  $scope.signedOut = false;
  $scope.userName = ''
