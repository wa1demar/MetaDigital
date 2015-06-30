(function () {

    "use strict";

    angular.module('metaDigitalApp')
        .controller('HomeController', ['$scope', function ($scope) {

            $scope.getHtml = function(html){
                return $sce.trustAsHtml(html);
            };

            $scope.locale = 'ru';
            $scope.t = {
                en: {webdevelopment: 'WEB - DEVELOPMENT'},
                ru: {webdevelopment: 'WEB - РАЗРАБОТКА'}
            };

            var setLocale = function(locale){
                console.log(locale);
                $scope.$apply(function(){
                    $scope.locale = locale;
                });
            };

            var Alert = new languageBox();
            Alert.render().enCallback(function(){
                setLocale('en');
                Alert.close();
            }).ruCallback(function(){
                setLocale('ru');
                Alert.close();
            });
        }])
}());