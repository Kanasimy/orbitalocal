/*! @source http://purl.eligrey.com/github/classList.js/blob/master/classList.js */
"document"in self&&("classList"in document.createElement("_")&&(!document.createElementNS||"classList"in document.createElementNS("http://www.w3.org/2000/svg","g"))||!function(t){"use strict";if("Element"in t){var e="classList",n="prototype",i=t.Element[n],s=Object,r=String[n].trim||function(){return this.replace(/^\s+|\s+$/g,"")},o=Array[n].indexOf||function(t){for(var e=0,n=this.length;n>e;e++)if(e in this&&this[e]===t)return e;return-1},a=function(t,e){this.name=t,this.code=DOMException[t],this.message=e},c=function(t,e){if(""===e)throw new a("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(e))throw new a("INVALID_CHARACTER_ERR","String contains an invalid character");return o.call(t,e)},l=function(t){for(var e=r.call(t.getAttribute("class")||""),n=e?e.split(/\s+/):[],i=0,s=n.length;s>i;i++)this.push(n[i]);this._updateClassName=function(){t.setAttribute("class",""+this)}},u=l[n]=[],h=function(){return new l(this)};if(a[n]=Error[n],u.item=function(t){return this[t]||null},u.contains=function(t){return t+="",-1!==c(this,t)},u.add=function(){var t,e=arguments,n=0,i=e.length,s=!1;do t=e[n]+"",-1===c(this,t)&&(this.push(t),s=!0);while(++n<i);s&&this._updateClassName()},u.remove=function(){var t,e,n=arguments,i=0,s=n.length,r=!1;do for(t=n[i]+"",e=c(this,t);-1!==e;)this.splice(e,1),r=!0,e=c(this,t);while(++i<s);r&&this._updateClassName()},u.toggle=function(t,e){t+="";var n=this.contains(t),i=n?e!==!0&&"remove":e!==!1&&"add";return i&&this[i](t),e===!0||e===!1?e:!n},u.toString=function(){return this.join(" ")},s.defineProperty){var f={get:h,enumerable:!0,configurable:!0};try{s.defineProperty(i,e,f)}catch(g){(void 0===g.number||-2146823252===g.number)&&(f.enumerable=!1,s.defineProperty(i,e,f))}}else s[n].__defineGetter__&&i.__defineGetter__(e,h)}}(self),function(){"use strict";var t=document.createElement("_");if(t.classList.add("c1","c2"),!t.classList.contains("c2")){var e=function(t){var e=DOMTokenList.prototype[t];DOMTokenList.prototype[t]=function(t){var n,i=arguments.length;for(n=0;i>n;n++)t=arguments[n],e.call(this,t)}};e("add"),e("remove")}if(t.classList.toggle("c3",!1),t.classList.contains("c3")){var n=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(t,e){return 1 in arguments&&!this.contains(t)==!e?e:n.call(this,t)}}t=null}());

(function () {
    'use strict';

    var initParent = BX.Sale.OrderAjaxComponent.init,
        getBlockFooterParent = BX.Sale.OrderAjaxComponent.getBlockFooter,
        editOrderParent = BX.Sale.OrderAjaxComponent.editOrder,
        editActiveRegionBlockParent = BX.Sale.OrderAjaxComponent.editActiveRegionBlock,
        selectDeliveryParent = BX.Sale.OrderAjaxComponent.selectDelivery,
        selectPaySystemParent = BX.Sale.OrderAjaxComponent.selectPaySystem,
        createDeliveryItemParent = BX.Sale.OrderAjaxComponent.createDeliveryItem,
        createPaySystemItemParent =  BX.Sale.OrderAjaxComponent.createPaySystemItem,
        isValidFormParent = BX.Sale.OrderAjaxComponent.isValidForm,
        editPaySystemInfoParent = BX.Sale.OrderAjaxComponent.editPaySystemInfo,
        editDeliveryInfoParent = BX.Sale.OrderAjaxComponent.editDeliveryInfo
    ;

    BX.namespace('BX.Sale.OrderAjaxComponentExt');

    BX.Sale.OrderAjaxComponentExt = BX.Sale.OrderAjaxComponent;

    BX.Sale.OrderAjaxComponentExt.getCookie= function (name) {

        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    BX.Sale.OrderAjaxComponentExt.init = function (parameters) {
        this.changed = {};
        this.deliveryShow = '';
        initParent.apply(this, arguments);
        /*Agree*/
        var agree = document.getElementById('agree');
        var btnBuy = document.getElementById('buy');
        agree.onclick = function() {
            if (agree.checked) {
                btnBuy.disabled="";
            } else {btnBuy.disabled="disabled";};
        };

        var editSteps = this.orderBlockNode.querySelectorAll('.bx-soa-editstep'), i;
        for (i in editSteps) {
            if (editSteps.hasOwnProperty(i)) {
                BX.remove(editSteps[i]);
            }
        }
        if(this.getCookie('surfEmail')){document.getElementById('soa-property-2').value = this.getCookie('surfEmail');}
        document.body.querySelector('#bx-soa-region .bx-soa-section-content').style.display='block';
        var adress = document.body.querySelector('[data-property-id-row="5"]');
        var nextAdress = document.getElementById('bx-soa-delivery');
        var comment = document.getElementById('orderDescription').parentNode.parentNode;
        comment.setAttribute("class", "bx-soa-section bx-active bx-selected");
        var nextComment = document.getElementById('bx-soa-orderSave');

        if(adress){document.getElementById('bx-soa').insertBefore(adress, nextAdress);}
        document.getElementById('bx-soa').insertBefore(comment, nextComment);
        //document.body.querySelector('.bx-soa-price-free').parentElement.parentElement.style.display='none';
    };

    BX.Sale.OrderAjaxComponentExt.isValidPayDelivery = function(item) {
        var payItem = document.getElementsByName('PAY_SYSTEM_ID'),
            deliveryItem = document.getElementsByName('DELIVERY_ID'), payBlock = BX('bx-soa-paysystem'),
            deliveryBlock = BX('bx-soa-delivery'), deliveryErrors = 'Вы должны выбрать способ доставки',
            payErrors = 'Вы должны выбрать способ оплаты', result = [], i = 0, count = 0;
        switch(item) {
            case 'pay':
                if(payItem.length>0){
                    for(i = 0; i < payItem.length; i++) {
                        if(payItem[i].checked) {
                            count++;
                        }
                    }
                    if(!count) {
                        this.showValidationResult(payBlock, payErrors);
                        result.push(payErrors);
                    }
                }

                break;
            case 'delivery':
                if(deliveryItem.length>0){
                    for(i = 0; i < deliveryItem.length; i++) {
                        if(deliveryItem[i].checked) {
                            count++;
                        }

                    }
                    if(!count) {
                        this.showValidationResult(deliveryBlock, deliveryErrors);
                        result.push(deliveryErrors);
                    }
                }
                break;
        };
        return result;
    };

    BX.Sale.OrderAjaxComponentExt.isValidForm = function() {
        var payErrors = this.isValidPayDelivery('pay'), deliveryErrors = this.isValidPayDelivery('delivery'),
            navigated = false, result = isValidFormParent.apply(this, arguments);
        navigated = !result;
        if(deliveryErrors.length && !navigated) {
            navigated = true;
            this.animateScrollTo(this.deliveryBlockNode, 800, 50);
        }

        if(payErrors.length && !navigated) {
            navigated = true;
            this.animateScrollTo(this.paySystemBlockNode, 800, 50);
        }
        if(payErrors.length) {
            this.showError(this.paySystemBlockNode, payErrors);
        }
        if(deliveryErrors.length) {
            this.showError(this.deliveryBlockNode, deliveryErrors);
        }
        return !(deliveryErrors.length + payErrors.length);
    };

    BX.Sale.OrderAjaxComponentExt.getBlockFooter = function (node) {
        var parentNodeSection = BX.findParent(node, {className: 'bx-soa-section'});

        getBlockFooterParent.apply(this, arguments);

        if (/bx-soa-auth|bx-soa-properties|bx-soa-region|bx-soa-delivery|bx-soa-paysystem|bx-soa-basket/.test(parentNodeSection.id)) {
            BX.remove(parentNodeSection.querySelector('.pull-left'));
        }
        if (/bx-soa-auth|bx-soa-properties|bx-soa-region|bx-soa-paysystem|bx-soa-delivery|bx-soa-basket/.test(parentNodeSection.id)) {
            BX.remove(parentNodeSection.querySelector('.pull-right'));
        }


    };

    BX.Sale.OrderAjaxComponentExt.editActiveRegionBlock = function(active) {
        editActiveRegionBlockParent.apply(this, arguments);

        var adress = document.querySelectorAll('[data-property-id-row="5"]');

        if(adress.length>1) {
            var adressParent = adress[1].parentElement;
            adressParent.removeChild(adress[1]);
        }

        var comment = document.getElementById('orderDescription').parentNode.parentNode;
        comment.setAttribute("class", "bx-soa-section bx-active bx-selected");
        var nextComment = document.getElementById('bx-soa-orderSave');
        document.getElementById('bx-soa').insertBefore(comment, nextComment);

    },

        BX.Sale.OrderAjaxComponentExt.editOrder = function (section) {

            editOrderParent.apply(this, arguments);

            var sections = this.orderBlockNode.querySelectorAll('.bx-soa-section.bx-active'), i;

            for(var i=0; i<sections.length; i++) {
                if (sections.hasOwnProperty(i)) {
                    if (!(/bx-soa-auth|bx-soa-properties|bx-soa-region|bx-soa-delivery|bx-soa-paysystem|bx-soa-basket/.test(sections[i].id))) {
                        var classString = sections[i].getAttribute('class')+' bx-soa-section-hide';

                        sections[i].setAttribute('class',classString);
                    }
                }
            }

            this.show(BX('bx-soa-properties'));
            this.show(BX('bx-soa-delivery'));
            this.show(BX('bx-soa-paysystem'));
            this.show(BX('bx-soa-region'));

            this.editActiveBasketBlock(true);

            this.alignBasketColumns();

            if (!this.result.IS_AUTHORIZED) {
                this.switchOrderSaveButtons(true);
            }

        };

    BX.Sale.OrderAjaxComponentExt.createDeliveryItem = function (item) {
        var result = createDeliveryItemParent.apply(this, arguments);
        this.deliveryShow = typeof result;
        return result;
    };

    BX.Sale.OrderAjaxComponentExt.getDeliveryLocationInput = function(node)
    { console.log(this);
        debugger;
        if(this.deliveryShow) {
            var currentProperty, locationId, altId, location, k, altProperty, labelHtml, currentLocation, insertedLoc,
                labelTextHtml, label, input, altNode;
            for(k in this.result.ORDER_PROP.properties) {
                if(this.result.ORDER_PROP.properties.hasOwnProperty(k)) {
                    currentProperty = this.result.ORDER_PROP.properties[k];
                    if(currentProperty.IS_LOCATION == 'Y') {
                        locationId = currentProperty.ID;
                        altId = parseInt(currentProperty.INPUT_FIELD_LOCATION);
                        break;
                    }
                }
            }
            location = this.locations[locationId];
            if(location && location[0] && location[0].output) {
                this.regionBlockNotEmpty = true;
                labelHtml = '<label class="bx-soa-custom-label" for="soa-property-' + locationId + '">' + (currentProperty.REQUIRED == 'Y' ? '<span class="bx-authform-starrequired">*</span> ' : '') + BX.util.htmlspecialchars(currentProperty.NAME) + (currentProperty.DESCRIPTION.length ? ' <small>(' + BX.util.htmlspecialchars(currentProperty.DESCRIPTION) + ')</small>' : '') + '</label>';
                currentLocation = location[0].output;
                insertedLoc = BX.create('DIV', {
                    attrs: {'data-property-id-row': locationId},
                    props: {className: 'form-group bx-soa-location-input-container'},
                    style: {visibility: 'hidden'},
                    html: labelHtml + currentLocation.HTML
                });
                node.appendChild(insertedLoc);
                node.appendChild(BX.create('INPUT', {
                    props: {
                        type: 'hidden', name: 'RECENT_DELIVERY_VALUE', value: location[0].lastValue
                    }
                }));
                for(k in currentLocation.SCRIPT) if(currentLocation.SCRIPT.hasOwnProperty(k)) BX.evalGlobal(currentLocation.SCRIPT[k].JS);
            }
            if(location && location[0] && location[0].showAlt && altId > 0) {
                for(k in this.result.ORDER_PROP.properties) {
                    if(parseInt(this.result.ORDER_PROP.properties[k].ID) == altId) {
                        altProperty = this.result.ORDER_PROP.properties[k];
                        break;
                    }
                }
            }
            if(altProperty) {
                altNode = BX.create('DIV', {
                    attrs: {'data-property-id-row': altProperty.ID},
                    props: {className: "form-group bx-soa-location-input-container"}
                });
                labelTextHtml = altProperty.REQUIRED == 'Y' ? '<span class="bx-authform-starrequired">*</span> ' : '';
                labelTextHtml += BX.util.htmlspecialchars(altProperty.NAME);
                label = BX.create('LABEL', {
                    attrs: {for: 'altProperty'}, props: {className: 'bx-soa-custom-label'}, html: labelTextHtml
                });
                input = BX.create('INPUT', {
                    props: {
                        id: 'altProperty',
                        type: 'text',
                        placeholder: altProperty.DESCRIPTION,
                        autocomplete: 'city',
                        className: 'form-control bx-soa-customer-input bx-ios-fix',
                        name: 'ORDER_PROP_' + altProperty.ID,
                        value: altProperty.VALUE
                    }
                });
                altNode.appendChild(label);
                altNode.appendChild(input);
                node.appendChild(altNode);
                this.bindValidation(altProperty.ID, altNode);
            }
            this.getZipLocationInput(node);
            if(location && location[0]) {
                node.appendChild(BX.create('DIV', {
                    props: {className: 'bx-soa-reference'}, html: this.params.MESS_REGION_REFERENCE
                }));
            }
        }};

    BX.Sale.OrderAjaxComponentExt.createPaySystemItem = function (item) {
        // this.changed.paySystem ? item.CHECKED == 'Y' : delete item.CHECKED;
        return createPaySystemItemParent.apply(this, arguments);
    };

    BX.Sale.OrderAjaxComponentExt.selectPaySystem = function (event) {
        this.changed.paySystem = true;
        selectPaySystemParent.apply(this, arguments);
    };

    BX.Sale.OrderAjaxComponentExt.selectDelivery = function (event) {
        this.changed.delivery = true;
        selectDeliveryParent.apply(this, arguments);
    };

    BX.Sale.OrderAjaxComponentExt.editDeliveryInfo = function (deliveryNode) {
        if(this.changed.delivery) {editDeliveryInfoParent.apply(this, arguments);}
    };

    BX.Sale.OrderAjaxComponentExt.editPaySystemInfo = function (paySystemNode) {
        if(this.changed.paySystem) { editPaySystemInfoParent.apply(this, arguments);}
    };

    BX.Sale.OrderAjaxComponentExt.editActiveRegionBlock = function(activeNodeMode) {
        var node = activeNodeMode ? this.regionBlockNode : this.regionHiddenBlockNode,
            regionContent, regionNode, regionNodeCol;
        if (this.initialized.region)
        {
            BX.remove(BX.lastChild(node));
            if(BX.firstChild(this.regionHiddenBlockNode))
            {node.appendChild(BX.firstChild(this.regionHiddenBlockNode));}
            else{
                regionContent = node.querySelector('.bx-soa-section-content');
                if (!regionContent)
                {
                    regionContent = this.getNewContainer();
                    node.appendChild(regionContent);
                }
                else
                    BX.cleanNode(regionContent);

                this.getErrorContainer(regionContent);

                regionNode = BX.create('DIV', {props: {className: 'bx_soa_location row'}});
                regionNodeCol = BX.create('DIV', {props: {className: 'col-xs-12'}});

                this.getPersonTypeControl(regionNodeCol);

                this.getProfilesControl(regionNodeCol);

                this.getDeliveryLocationInput(regionNodeCol);

                if (!this.result.SHOW_AUTH)
                {
                    if (this.regionBlockNotEmpty)
                    {
                        BX.addClass(this.regionBlockNode, 'bx-active');
                        this.regionBlockNode.style.display = '';
                    }
                    else
                    {
                        BX.removeClass(this.regionBlockNode, 'bx-active');
                        this.regionBlockNode.style.display = 'none';

                        if (!this.result.IS_AUTHORIZED || typeof this.result.LAST_ORDER_DATA.FAIL !== 'undefined')
                            this.initFirstSection();
                    }
                }

                regionNode.appendChild(regionNodeCol);
                regionContent.appendChild(regionNode);
                this.getBlockFooter(regionContent);
            }

        }
        else
        {
            regionContent = node.querySelector('.bx-soa-section-content');
            if (!regionContent)
            {
                regionContent = this.getNewContainer();
                node.appendChild(regionContent);
            }
            else
                BX.cleanNode(regionContent);

            this.getErrorContainer(regionContent);

            regionNode = BX.create('DIV', {props: {className: 'bx_soa_location row'}});
            regionNodeCol = BX.create('DIV', {props: {className: 'col-xs-12'}});

            this.getPersonTypeControl(regionNodeCol);

            this.getProfilesControl(regionNodeCol);

            this.getDeliveryLocationInput(regionNodeCol);

            if (!this.result.SHOW_AUTH)
            {
                if (this.regionBlockNotEmpty)
                {
                    BX.addClass(this.regionBlockNode, 'bx-active');
                    this.regionBlockNode.style.display = '';
                }
                else
                {
                    BX.removeClass(this.regionBlockNode, 'bx-active');
                    this.regionBlockNode.style.display = 'none';

                    if (!this.result.IS_AUTHORIZED || typeof this.result.LAST_ORDER_DATA.FAIL !== 'undefined')
                        this.initFirstSection();
                }
            }

            regionNode.appendChild(regionNodeCol);
            regionContent.appendChild(regionNode);
            this.getBlockFooter(regionContent);
        }
    };

    BX.Sale.OrderAjaxComponentExt.editFadePropsContent = function(activeNodeMode) {};
})();
