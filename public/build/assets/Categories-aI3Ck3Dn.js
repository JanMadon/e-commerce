import{m as H,f as i,n as S,o as v,h,p as J,q as K,r as d,T as Q,c as W,b as l,d as e,i as P,F as L,k as c,l as u,t as n,j as T,e as m,u as p,v as w,O as R,s as X}from"./app-oW-6Vp7S.js";import{_ as Y}from"./AdminLayout-UXLIDKRm.js";import{P as D}from"./PrimaryButton-yhvIDqDu.js";import{_ as U}from"./SecondaryButton-ZSgtFGuS.js";import{_ as Z}from"./Modal-HncGjjiy.js";import{s as j,a as F}from"./CategoryBar-m9iwuleY.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const q={__name:"CategorySpan",props:{active:{type:Boolean},show:{type:Boolean}},setup(f){const E=f,a=H(()=>E.active?"flex items-center px-5 py-2 mr-5  rounded-lg border-b border-blue-900 font-bold leading-5 text-blue-900 bg-gray-200 focus:outline-none focus:border-blue-900 transition duration-150 ease-in-out cursor-pointer":"flex items-center px-4 py-2 rounded-lg border-2 border-transparent font-medium leading-5 text-gray-900 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-ou cursor-pointer");return(_,x)=>i((v(),h("span",{class:K(a.value)},[J(_.$slots,"default")],2)),[[S,f.show]])}},ee={class:"max-w-4xl mx-auto my-5 bg-gray-100 dark:bg-gray-600 rounded-xl p-6 shadow-md"},te=e("h2",{class:"w-1/2 text-2xl font-semibold mb-4 border-b-2 border-gray-300 drop-shadow"},"Categories",-1),oe={class:"flex"},se={class:"w-2/3 mt-10 transition duration-900"},re={class:"flex justify-between w-2/3 border-b"},ae=["onClick"],le=["onClick"],ne={key:0,class:"mx-5 p-5 text-center bg-gray-200 border rounded-xl shadow-md"},ie=e("label",{for:"name",class:"block text-sm font-medium text-gray-600"},"Category name:",-1),de={class:"text-red-600 text-xs"},ce=e("label",{for:"description",class:"block text-sm font-medium text-gray-600"},"Description",-1),ue={class:"text-red-600 text-xs"},me={class:"text-right"},pe={class:"w-2/3"},ve=e("h3",{class:"text-xl font-bold border-b border-gray-300 drop-shadow"}," Subcategories ",-1),fe={class:"pt-5 pl-5"},xe={class:"m-2 flex justify-between w-2/3 border-b"},ge=["onClick"],be=["onClick"],he=["onClick"],_e={key:0,class:"mx-5 p-5 text-center bg-gray-200 border rounded-xl shadow-md"},ye=e("label",{for:"name",class:"block text-sm font-medium text-gray-600"},"Subcategory name:",-1),we={class:"text-red-600 text-xs"},ke=e("label",{for:"description",class:"block text-sm font-medium text-gray-600"},"Description",-1),Ce={class:"text-red-600 text-xs"},$e={class:"text-right"},Se={class:"m-4"},Ee={class:"text-xl font-bold"},Ie=e("label",{for:"name",class:"block text-sm font-medium text-gray-600"},"Name:",-1),Ve={class:"text-red-600 text-xs"},Ne=e("label",{for:"description",class:"block text-sm font-medium text-gray-600"},"Description",-1),Be={class:"text-red-600 text-xs"},Te={class:"text-right"},Pe={__name:"Categories",props:{categories:Object,subcategories:Object},setup(f){const E=f,a=d(),_=d(),x=d(),k=d(!1),g=d(!1),I=d(!1),V=d(),b=d(),C=d(),y=d(),r=Q({parentId:null,type:"",name:"",description:""}),A=s=>{x.value=s,a.value=E.categories[s]},N=()=>{k.value=!1,g.value=!1,r.name="",r.description="",a.value=null},O=(s,o,t,$)=>{I.value=!0,y.value=$,V.value=s,b.value=o,C.value=t},B=()=>{V.value=null,b.value=null,C.value=null,I.value=!1,a.value=null},G=()=>{let s=null;y.value==="subcategory"&&(s=a.value.id),R.put(route("categories.edit",{parentId:s}),{type:y.value,id:V.value,name:b.value,description:C.value},{onSuccess:()=>{j(`The ${b.value} ${y.value} edition was a success`),B()},onError:()=>{F(`The ${b.value} ${y.value} editing failed`)}})},M=(s,o)=>{R.delete(route("categories.delete",{id:s,parentId:o}),{onSuccess:()=>{j("Removing category was successful"),B()},onError:()=>{F("The category removal failed")}})},z=s=>{r.type=s,s==="subcategory"&&(r.parentId=a.value.id),r.post(route("categories.create"),{onSuccess:()=>{j(`The creation of a new ${s} was successful`),N()},onError:()=>{F(`Creating a new  ${s} failed`)}})};return(s,o)=>(v(),W(Y,null,{default:l(()=>[e("div",ee,[te,e("div",oe,[e("div",se,[(v(!0),h(L,null,P(f.categories,(t,$)=>(v(),h("div",re,[c(q,{show:!0,active:$==x.value,onClick:De=>A($)},{default:l(()=>[u(n(t.name),1)]),_:2},1032,["active","onClick"]),e("div",null,[e("span",{onClick:m(()=>O(t.id,t.name,t.description,"category"),["prevent"]),class:"mt-2 mx-3 text-sm text-blue-600 cursor-pointer"}," edit ",8,ae),e("span",{onClick:m(()=>M(t.id),["prevent"]),class:"mt-2 text-sm text-red-600 cursor-pointer"}," remove ",8,le)])]))),256)),i(c(q,{onClick:o[0]||(o[0]=()=>{k.value=!0,x.value=s.flase}),class:"w-min mx-2 text-xl rounded-2xl hover:bg-gray-200"},{default:l(()=>[u(" + ")]),_:1},512),[[S,!k.value&&!g.value]]),f.categories[x.value]&&!g.value?(v(),h("div",ne,n(f.categories[x.value].description),1)):T("",!0),i(e("form",{onSubmit:o[3]||(o[3]=m(()=>z("category"),["prevent"])),class:"m-4"},[ie,i(e("input",{type:"text","onUpdate:modelValue":o[1]||(o[1]=t=>p(r).name=t),class:"mt-1 p-2 w-2/3 border rounded-md",placeholder:"Enter the name of the category",required:""},null,512),[[w,p(r).name]]),e("p",de,n(s.$page.props.errors.name),1),ce,i(e("textarea",{rows:"3","onUpdate:modelValue":o[2]||(o[2]=t=>p(r).description=t),class:"mt-1 p-2 w-full border rounded-md",placeholder:"Enter destription of the category"},null,512),[[w,p(r).description]]),e("p",ue,n(s.$page.props.errors.description),1),e("div",me,[c(U,{class:"mx-5",onClick:m(N,["prevent"])},{default:l(()=>[u("cancel")]),_:1}),c(D,null,{default:l(()=>[u("create")]),_:1})])],544),[[S,k.value]])]),e("div",pe,[ve,e("div",fe,[a.value?(v(!0),h(L,{key:0},P(a.value.sub_category,(t,$)=>(v(),h("li",xe,[e("p",{style:X(_.value===t?"font-weight: bold":""),onClick:()=>_.value=t,class:"cursor-pointer"},n(t.name),13,ge),e("div",null,[e("span",{onClick:m(()=>O(t.id,t.name,t.description,"subcategory"),["prevent"]),class:"mr-2 text-sm text-blue-600 cursor-pointer"}," edit ",8,be),e("span",{onClick:m(()=>M(t.id,a.value.id),["prevent"]),class:"text-sm text-red-600 cursor-pointer"}," remove ",8,he)])]))),256)):T("",!0)]),i(c(q,{onClick:o[4]||(o[4]=()=>{g.value=!0,x.value=s.flase}),class:"w-min ml-4 text-xl rounded-2xl hover:bg-gray-200"},{default:l(()=>[u(" + ")]),_:1},512),[[S,!k.value&&!g.value&&a.value]]),_.value&&!g.value?(v(),h("div",_e,n(_.value.description),1)):T("",!0),i(e("form",{onSubmit:o[7]||(o[7]=m(()=>z("subcategory"),["prevent"])),class:"m-4"},[ye,i(e("input",{type:"text","onUpdate:modelValue":o[5]||(o[5]=t=>p(r).name=t),class:"mt-1 p-2 w-2/3 border rounded-md",placeholder:"Enter the name of the subcategory",required:""},null,512),[[w,p(r).name]]),e("p",we,n(s.$page.props.errors.name),1),ke,i(e("textarea",{rows:"3","onUpdate:modelValue":o[6]||(o[6]=t=>p(r).description=t),class:"mt-1 p-2 w-full border rounded-md",placeholder:"Enter destription of the subcategory"},null,512),[[w,p(r).description]]),e("p",Ce,n(s.$page.props.errors.description),1),e("div",$e,[c(U,{class:"mx-5",onClick:m(N,["prevent"])},{default:l(()=>[u("cancel")]),_:1}),c(D,null,{default:l(()=>[u("create")]),_:1})])],544),[[S,g.value]])])])]),c(Z,{show:I.value,"max-width":"lg"},{default:l(()=>[e("div",Se,[e("h3",Ee,"Edit "+n(y.value),1),Ie,i(e("input",{type:"text","onUpdate:modelValue":o[8]||(o[8]=t=>b.value=t),class:"mt-1 p-2 w-2/3 border rounded-md",required:""},null,512),[[w,b.value]]),e("p",Ve,n(s.$page.props.errors.name),1),Ne,i(e("textarea",{rows:"3","onUpdate:modelValue":o[9]||(o[9]=t=>C.value=t),class:"mt-1 p-2 w-full border rounded-md",placeholder:"Enter destription of the category"},null,512),[[w,C.value]]),e("p",Be,n(s.$page.props.errors.description),1),e("div",Te,[c(U,{onClick:B,class:"mx-5"},{default:l(()=>[u("close")]),_:1}),c(D,{onClick:G},{default:l(()=>[u("edit")]),_:1})])])]),_:1},8,["show"])]),_:1}))}};export{Pe as default};
