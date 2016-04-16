app = angular.module('main', [])

app.controller 'MainCtrl', ($scope) ->
  $scope.posts =  [
                    {'user': 'U1','content': 'loloolol','timestamp': 1400100000000}
                  ]
  $scope.create = (post) ->
                    $scope.posts.push({'user': this.userName,'content': post.content,'timestamp': Date.now()})
                    post.content = ''
  $scope.signedOut = false;
  $scope.userName = ''
