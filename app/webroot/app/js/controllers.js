(function() {
    var as = angular.module('myApp.controllers', []);
    as.controller('AppCtrl', function($scope, $rootScope, $http, i18n, $location) {
        $scope.language = function() {
            return i18n.language;
        };
        $scope.setLanguage = function(lang) {
            i18n.setLanguage(lang);
        };
        $scope.activeWhen = function(value) {
            return value ? 'active' : '';
        };

        $scope.path = function() {
            return $location.url();
        };

//        $scope.login = function() {
//            $scope.$emit('event:loginRequest', $scope.username, $scope.password);
//            //$location.path('/login');
//        };

        $scope.logout = function() {
            $rootScope.user = null;
            $scope.username = $scope.password = null;
            $scope.$emit('event:logoutRequest');
            $location.url('/');
        };

        $rootScope.appUrl = "http://192.168.100.2";

    });

    as.controller('NewsitemListCtrl', function($scope, $rootScope, $http, $location) {
        var load = function() {
            console.log('call load()...');
            $http.get('../newsitems.json')
                    .success(function(data, status, headers, config) {
                        $scope.newsitems = data.newsitems;
                        angular.copy($scope.newsitems, $scope.copy);
                    });
        }

        load();
       
        $scope.ViewNews = function(index) {
            console.log('call view news');
            $location.path('/view-news/' + $scope.newsitems[index].Newsitem.id);
        }
    });
    as.controller('ViewNewsitemCtrl', function($scope, $rootScope, $http, $routeParams, $location){
        var load = function() {
            console.log('call load()...');
            $http.get('../newsitems/' + $routeParams['id'] + '.json')
                    .success(function(data, status, headers, config) {
                        $scope.newsitem = data.newsitem.Newsitem;
                        angular.copy($scope.newsitem, $scope.copy);
                    });
        };

        load();
    });
}());