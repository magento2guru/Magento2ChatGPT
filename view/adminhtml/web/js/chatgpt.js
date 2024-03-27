// define([
//     'jquery',
//     'uiComponent',
// ], function ($, Component) {
//     'use strict';
//
//     return Component.extend({
//
//
//         /** @inheritdoc */
//         initialize: function (config, messageContainer) {
//             this._super()
//                 .initObservable();
//
//
//             return this;
//         },
//
//
//         test: function (){
//             console.log(123);
//         }
//     });
// });


require(
    [
        'jquery',
        'mage/translate',
        'Magento2Developer_ChatGPT/js/alpinejs.min'
    ],
    function ($,_,Alpine) {
        console.log(Alpine);


        $(document).ajaxComplete(function() {

            Alpine.data('chatgtp', () => ({
                lastFocus: null,
                init: function(){
                    let self = this;
                    window.onload = function() {
                        jQuery('input').focus(function () {
                            self.lastFocus = jQuery(this);
                        })
                    };
                },
                open: false,
                //backendUrl: <?php echo json_encode($this->getUrl('chatgpt/index/index')) ?>,
            request: async function () {
                console.log(this.lastFocus);
                //const res = await fetch(this.backendUrl).then(response => response.json())

            }
            }));

            Alpine.start()

        });









        // $(window).load(function() {
        //     console.log($$('.admin__field').length);
        //     console.log($$('.admin__field').length);
        //     $$('.admin__field').each((el)=>{
        //         //console.log($(el).find('input'));
        //         if ($(el).find('textarea').length > 0) {
        //             console.log(el);
        //         }
        //     });
        // });


    }
);
