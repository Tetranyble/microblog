app = angular.module('main', [])

app.controller 'MainCtrl', ($scope) ->
  $scope.posts =  [
                    {'user': 'U1','content': 'loloolol','timestamp': 1400100000000}
                  ]
  $scope.create = (post) ->
                    $scope.posts.push({'user': 'U1','content': post.content,'timestamp': Date.now()})
                    post.content = ''
