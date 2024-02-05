import{_ as g}from"./AdminLayout-efJ2Zqlw.js";import{C as m,p as b,a as p,b as x,B as y,c as v,L as j,A as C,D as O}from"./index-Oo9pLAPl.js";import{_ as D}from"./_plugin-vue_export-helper-x3n3nnut.js";import{x as N,o as a,c as h,r as B,y as L,b as P,d as t,t as e,h as r,i as u,F as _,k as w}from"./app-ozdChsqm.js";import"./index-KCY-3yKq.js";m.register(b,p,x,y,v,j,C);const k={name:"BarChart",components:{Doughnut:O},props:{},props:{chartData:{type:Object,required:!1},chartOptions:{type:Object,default:{responsive:!0,backgroundColor:["rgb(75, 192, 192)","rgb(255, 205, 86)","rgb(54, 162, 235)","rgb(255, 99, 132)","rgb(153, 102, 255)","rgb(255, 159, 64)","rgb(128, 128, 128)","rgb(0, 128, 0)","rgb(255, 0, 0)"],offset:2}}}};function U(o,d,l,i,n,c){const s=N("Doughnut");return a(),h(s,{id:"my-chart-id",options:l.chartOptions,data:l.chartData,arc:45},null,8,["options","data"])}const I=D(k,[["render",U]]),$=t("nav",{class:"flex items-center justify-between p-1 bm-3"},null,-1),A={class:"mx-8"},E=t("h2",{class:"text-2xl font-bold"},"Dashboard",-1),S={class:"grid grid-cols-5 gap-5 h-32"},F={class:"flex flex-col justify-center items-center bg-gray-100 rounded-xl"},T=t("h4",{class:"font-bold"},"Logged in users now",-1),V={class:"m-3 text-2xl font-bold"},q={class:"flex flex-col justify-center items-center bg-gray-100 rounded-xl"},M=t("h4",{class:"font-bold"},"Registered users",-1),R={class:"m-3 text-2xl font-bold"},z={class:"flex flex-col justify-center items-center bg-gray-100 rounded-xl"},G=t("h4",{class:"font-bold"},"Active products",-1),H={class:"m-3 text-2xl font-bold"},J={class:"flex flex-col justify-center items-center bg-gray-100 rounded-xl"},K=t("h4",{class:"font-bold"},"Paid orders",-1),Q={class:"m-3 text-2xl font-bold"},W={class:"flex flex-col justify-center items-center bg-gray-100 rounded-xl"},X=t("h4",{class:"font-bold"},"Total Income",-1),Y={class:"m-3 text-2xl font-bold"},Z={class:"grid grid-cols-3 gap-5 h-fit my-5"},tt={class:"col-span-2 row-span-2 p-5 rounded-xl bg-gray-100"},st=t("h4",{class:"text-lg font-bold"},"Latest orders",-1),et={class:"p-3 border-b"},ot={class:"flex"},at={class:"mr-2 font-bold text-blue-700"},lt={class:"flex justify-between"},nt={class:"flex flex-col items-center p-2 pt-5 bg-gray-100 rounded-xl"},ct=t("h4",{class:"text-lg font-bold"},"Orders by categories",-1),rt={class:"flex flex-col items-center p-2 pt-5 bg-gray-100 rounded-xl"},dt=t("h4",{class:"text-lg font-bold"},"Latest Customers",-1),it={class:"flex justify-between w-full"},ut=t("div",null,null,-1),bt={__name:"Dashboard",props:{loggedInUsers:Number,registeredUsers:Number,activeProducts:Number,paidOrders:Number,totalIncome:Number,mostPopularCategory:Object,latestUsers:Object,latestOrders:Object},setup(o){const d=o,l=B({}),i=()=>{const n=[],c=[];for(const s in d.mostPopularCategory){const f=d.mostPopularCategory[s];n.push(s),c.push(f)}l.value={labels:n,datasets:[{data:c}]}};return L(()=>{i()}),(n,c)=>(a(),h(g,null,{default:P(()=>[$,t("div",A,[E,t("div",S,[t("div",F,[T,t("p",V,e(o.loggedInUsers),1)]),t("div",q,[M,t("p",R,e(o.registeredUsers),1)]),t("div",z,[G,t("p",H,e(o.activeProducts),1)]),t("div",J,[K,t("p",Q,e(o.paidOrders),1)]),t("div",W,[X,t("p",Y,"PLN "+e(o.totalIncome),1)])]),t("div",Z,[t("div",tt,[st,(a(!0),r(_,null,u(o.latestOrders,s=>(a(),r("div",et,[t("div",ot,[t("p",at,"Order #"+e(s.id),1),t("p",null,e(s.latest)+", "+e(s.detals_order.length)+" items",1)]),t("div",lt,[t("p",null,e(s.user.firstname)+" "+e(s.user.lastname),1),t("p",null,"PLN "+e(s.amount_paid),1)])]))),256))]),t("div",nt,[ct,w(I,{chartData:l.value},null,8,["chartData"])]),t("div",rt,[dt,(a(!0),r(_,null,u(o.latestUsers,s=>(a(),r("div",it,[t("p",null,e(s.firstname)+" "+e(s.lastname),1),t("p",null,e(s.lastTime),1)]))),256))])])]),ut]),_:1}))}};export{bt as default};
