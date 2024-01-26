import{r as n,w as q,o as i,h,k as u,b as p,l as b,d as e,F as B,G as D,c as $,i as T,t as c,f as E,g as Y,e as j,A as N,O as L}from"./app-oW-6Vp7S.js";import{_ as V}from"./GuestUserLayout-XaRXaiyK.js";import{P as K}from"./PrimaryButton-yhvIDqDu.js";import{D as W}from"./DangerButton-S8ptbFtf.js";import{_ as g}from"./Modal-HncGjjiy.js";import{_ as R}from"./SecondaryButton-ZSgtFGuS.js";import G from"./UserAddress-IyH8VSwe.js";import{a as y,s as M}from"./CategoryBar-m9iwuleY.js";import"./_plugin-vue_export-helper-x3n3nnut.js";import"./InputLabel-LJ06lLA3.js";import"./TextInput-IEKXRnOs.js";const H={class:"h-2/3 dark:text-gray-100"},Q=e("h3",{class:"m-10 text-2xl font-bold text-center"},"e-shop KRAKÓW",-1),U={class:"m-10 text-center"},z=e("p",null,"Warehouse:",-1),J=e("p",null,"ul. Reymonta 20",-1),O=e("p",null,"30-059 Kraków",-1),X=e("p",null,"The store is open from Monday to Friday from 8 a.m. to 8 p.m",-1),Z={__name:"WarehouseAddressModal",props:{typeModal:String,showModalAgain:Boolean},setup(m){const l=m,d=n(!1),v=n(!1),f=n(!1);q(()=>[l.typeModal,l.showModalAgain],a);function a(){switch(l.typeModal){case"locker":case"lockerFree":v.value=!0;break;case"curier":f.value=!0;break;case"self":d.value=!0;break}}return(x,r)=>(i(),h(B,null,[u(g,{show:d.value,onClose:r[1]||(r[1]=()=>d.value=!1)},{default:p(()=>[e("div",H,[Q,e("div",U,[z,J,O,X,u(R,{onClick:r[0]||(r[0]=()=>d.value=!1),class:"mt-10"},{default:p(()=>[b(" Close ")]),_:1})])])]),_:1},8,["show"]),u(g,{show:f.value,onClose:r[3]||(r[3]=()=>f.value=!1)},{default:p(()=>[u(G,{closeBtn:!0,onCloseAction:r[2]||(r[2]=()=>f.value=!1),class:"p-10"})]),_:1},8,["show"]),u(g,{show:!1},{default:p(()=>[b(" modal3 ")]),_:1})],64))}},ee={key:0,class:"flex flex-col items-center mt-3 mx-auto text-gray-800 dark:text-gray-100"},te=e("div",{class:"flex w-2/3 p-2"},[e("h2",{class:"text-2xl font-bold text-left"},"Your Catr Items")],-1),oe=e("div",{class:"flex justify-between w-2/3 h-2/3 p-2 border bg-gray-100 border-gray-300 dark:bg-slate-600 rounded-xl shadow-2xl"},[e("p",{class:"text-center w-full"},"You don't have any items in cart")],-1),se=[te,oe],ae={key:1,class:"flex flex-col items-center mt-3 mx-auto text-gray-800 dark:text-gray-100"},re=e("div",{class:"flex w-2/3 p-2"},[e("h2",{class:"text-2xl font-bold text-left"},"Your Catr Items")],-1),le={class:"flex justify-between w-2/3 h-2/3 mx-5 p-5 bg-gray-100 border border-gray-300 dark:bg-slate-600 rounded-xl shadow-2xl"},ne={class:"flex"},de={class:"w-[80px] h-[80px] mx-3 bg-gray-200 rounded-lg cursor-pointer overflow-hidden hover:brightness-75 transition duration-300"},ie=["src"],ce={class:"flex flex-col justify-between"},ue={class:"text-lg font-bold"},pe={class:"text-xs"},he={class:"flex items-end"},fe=e("label",{for:"quantityfor",class:"mr-1 text-sm"},"Quantity:",-1),_e=["value","onInput"],me={class:"flex flex-col justify-between items-end"},ve={class:"text-lg font-bold"},ge=e("div",null,null,-1),xe=e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-5 h-5"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"})],-1),we={class:"flex justify-between w-2/3 h-2/3 mx-5 p-5 rounded-xl shadow-2xl border bg-gray-100 border-gray-300 text-gray-800 dark:text-gray-100 dark:bg-slate-600"},ye=e("p",{class:"font-bold"},"Total price:",-1),be={class:"mt-5 text-sm text-center font-bold"},ke={class:"flex text-xs gap-4 font-normal"},Me={class:"text-right"},Pe={class:"font-bold text-lg"},Ce={key:0,value:"lockerFree"},Se={key:1,value:"locker"},$e={value:"curier"},je={value:"self"},Ne=e("option",{value:"-"}," Please choose a shiping option",-1),Le=e("p",{class:"text-xs text-green-700"},"You can choose free parcel locker shipping!",-1),qe=[Le],Be={class:"flex justify-center w-2/3 h-2/3 p-2 bg-gray-100 border border-gray-300 dark:bg-slate-600 rounded-xl shadow-2xl"},Ie={key:0,class:"text-center w-full text-red-600"},Ae=e("div",{class:"bg-white p-10 rounded-md shadow-md"},[e("div",{class:"flex items-center justify-center mb-4"},[e("div",{class:"loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"})]),e("p",{class:"m-10 text-center"},"You will be redirected to the payment page...")],-1),Fe=e("div",{class:"bg-white p-10 rounded-md shadow-md"},[e("div",{class:"flex items-center justify-center mb-4"},[e("div",{class:"error ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"})]),e("p",{class:"m-10 text-center"},"Something went wrong, please try again later.")],-1),Ue={__name:"CartPage",props:{order:Object},setup(m){const l=m,d=n(),v=n(!1),f=n(!1),a=n("-"),x=n(!1),r=n(!1),k=n(!1),_=n({lockerFree:0,locker:10,curier:20,self:0,"-":0});function I(){if(a.value==="-"){y("Please select your shipping method.");return}r.value=!0,N.post(route("cart.payOrder"),{data:l.order}).then(o=>window.location.href=o.data.paymentPage).catch(o=>{r.value=!1,k.value=!0,console.log(o)})}q(a,()=>{P(),w()});function A(o,t){l.order.detals_order[t].quantity=parseInt(o.target.value),P(t),w()}function F(o,t){console.log(o,t),N.delete(route("cart.deleteProduct",{detalId:o})).then(s=>{console.log(s),s.data.detalId==o&&(l.order.detals_order.splice(t,1),s.data.countDetal===1&&(l.order.detals_order=null)),M("Product removed from cart."),w()}).catch(s=>{y("Something went wrong, please try again.")})}function P(o){const t=l.order.detals_order[o];t?L.patch(route("cart.updateOrder"),{productId:t.product.id,quantity:t.quantity,shipingMethod:a.value},{onSuccess:()=>{M("The number of products in the cart has been increased.")},onError:()=>{y("Something went wrong, please try again later.")}}):L.patch(route("cart.setShipmentMethod"),{shipingMethod:a.value},{onSuccess:()=>{M(`Selected shipping method: ${a.value}`)},onError:()=>{y("Something went wrong, please try again later.")}})}const w=()=>{d.value=0;for(const o of l.order.detals_order){if(o.quantity<=0){v.value=!0;break}else v.value=!1;d.value+=o.quantity*o.product.price,f.value=d.value>500}typeof parseInt(_.value[a.value])=="number"&&(d.value+=parseInt(_.value[a.value]))};return D(()=>{l.order.hasOwnProperty("detals_order")&&w()}),(o,t)=>(i(),$(V,null,{default:p(()=>[m.order.detals_order?(i(),h("div",ae,[re,(i(!0),h(B,null,T(m.order.detals_order,(s,C)=>(i(),h("div",le,[e("div",ne,[e("div",de,[e("img",{src:"data:image/pag;base64,"+s.product.photo,alt:"next-photo",class:"w-full h-full object-cover"},null,8,ie)]),e("div",ce,[e("h3",ue,c(s.product.name),1),e("p",pe,"Price per item: PLN "+c(s.product.price),1),e("div",he,[fe,e("input",{value:s.quantity,onInput:S=>A(S,C),type:"number",min:"1",class:"text-center w-16 h-7 border rounded dark:bg-slate-800"},null,40,_e)])])]),e("div",me,[e("p",ve,c(s.quantity*s.product.price)+" PLN",1),ge,u(W,{onClick:j(S=>F(s.id,C),["prevent"]),class:"px-0"},{default:p(()=>[xe]),_:2},1032,["onClick"])])]))),256)),e("div",we,[e("div",null,[ye,e("div",be,[b("Shipping "),e("div",ke,[e("p",null,"price: "+c(_.value[a.value]??"select option"),1),e("p",{onClick:t[0]||(t[0]=()=>x.value=!x.value),class:"cursor-pointer text-blue-600"}," detals delivery ")])])]),e("div",Me,[e("p",Pe,"PLN "+c(parseInt(d.value)),1),E(e("select",{"onUpdate:modelValue":t[1]||(t[1]=s=>a.value=s),name:"",id:"",class:"py-1 text-sm rounded dark:bg-slate-800"},[f.value?(i(),h("option",Ce,"Parcel locker - PLN "+c(_.value.lockerFree),1)):(i(),h("option",Se,"Parcel locker - PLN "+c(_.value.locker),1)),e("option",$e," Courier delivery - PLN "+c(_.value.curier),1),e("option",je," Self pickup - PLN "+c(_.value.self),1),Ne],512),[[Y,a.value]]),e("div",{onClick:t[2]||(t[2]=()=>o.showModal=!0),class:"cursor-pointer mt-3"},qe)])]),e("div",Be,[v.value?(i(),h("p",Ie,"Please provide correct quantyti!")):(i(),$(K,{key:1,class:"justify-center w-1/2 bg-orange-400 hover:bg-orange-600 focus:bg-orange-600",onClick:j(I,["prevent"])},{default:p(()=>[b(" Proceed to Checkout ")]),_:1}))])])):(i(),h("div",ee,se)),u(Z,{typeModal:a.value,showModalAgain:x.value},null,8,["typeModal","showModalAgain"]),u(g,{show:r.value},{default:p(()=>[Ae]),_:1},8,["show"]),u(g,{show:k.value,onClose:t[3]||(t[3]=()=>k.value=!1)},{default:p(()=>[Fe]),_:1},8,["show"])]),_:1}))}};export{Ue as default};