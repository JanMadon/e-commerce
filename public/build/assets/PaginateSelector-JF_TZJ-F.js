import{r as i,G as d,o as c,h as _,d as e,e as g,O as l}from"./app-O0YGpkNr.js";const p={class:""},u=e("label",{for:""},"Show on page: ",-1),h=["value"],f=e("option",{value:"5"},"5",-1),m=e("option",{value:"10"},"10",-1),v=e("option",{value:"15"},"15",-1),w=e("option",{value:"25"},"25",-1),k=[f,m,v,w],y={__name:"PaginateSelector",setup(b){let o="";const a=i(10);function s(t){o.set("perPage",t.target.value),l.get(window.location.pathname+"?"+o.toString())}return d(()=>{o=new URLSearchParams(window.location.search),o.get("perPage")&&(a.value=o.get("perPage"))}),(t,r)=>(c(),_("div",p,[u,e("select",{name:"",id:"",value:a.value,onInput:r[0]||(r[0]=g(n=>s(n),["prevent"])),class:"py-0 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"},k,40,h)]))}};export{y as _};