(function () {

    "use strict";

    angular.module('metaDigitalApp')
        .controller('HomeController', ['$scope', '$http', '$sce', function ($scope, $http, $sce) {


            $scope.getHtml = function(html){

                console.log(html);
                return $sce.trustAsHtml(html);
            };

            $scope.category_images = ["./wp-content/themes/metadigital/images/marketing-icon.png",
            "./wp-content/themes/metadigital/images/device-icon.png",
            "./wp-content/themes/metadigital/images/design-icon.png",
            "./wp-content/themes/metadigital/images/bitrix-icon.png",
            "./wp-content/themes/metadigital/images/applications-icon.png",
            "./wp-content/themes/metadigital/images/outstuffing-icon.png"];

            $scope.locale = 'ru';
            $scope.t = {
                en: {webdevelopment: 'WEB - DEVELOPMENT'},
                ru: {webdevelopment: 'WEB - РАЗРАБОТКА'}
            };

            var Alert = new languageBox();
            Alert.render().chooseCallback(function(lang){
                $scope.retriveCategories(lang);

                Alert.close();
            });

            $scope.retriveCategories = function(lang){
                $http.get('/api/service/get_all_categories/?lang=' + lang)
                    .success(function(data){
                        delete data.status;
                        $scope.locale = lang;
                        $scope.categories = data;

                        $scope.current_category = $scope.categories[0];
                        $scope.current_post = $scope.current_category.posts[0];
                    })
                    .error(function(){
                    });
            };

            $scope.console = {
              log: function(i){
                  console.log(i);
              }
            };
            $scope.retriveCategories('ru');
        }])
}());