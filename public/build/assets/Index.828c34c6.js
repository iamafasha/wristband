import{m as f,o as i,c,a as t,u as o,w as a,F as _,H as p,b as s,s as b,t as l,p as v,n as w,j as n}from"./app.8ee55d72.js";import{_ as g}from"./Authenticated.0fd431e8.js";import{_ as m}from"./Link.cf5d510e.js";import{_ as y}from"./Button.fd2d42fd.js";import"./ApplicationLogo.38102ed7.js";import"./plugin-vue_export-helper.21dcd24c.js";const x={class:"py-12"},D={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},N={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},$={class:"p-6 bg-white border-b border-gray-200"},j={class:"flex justify-end"},k=n("New Doctor"),B={class:"pt-5"},F={class:"doctors border-spacing-2 table w-full"},S={class:"doctor-name table-cell"},V={class:"doctor-name table-cell"},C={class:"doctor-name table-cell"},E={class:"doctor-phone table-cell"},H={class:"doctor-actions table-cell"},q={class:"flex justify-end"},z={class:"doctor-edit"},A=n("Edit"),I=["onSubmit"],L=n(" Delete "),R={__name:"Index",props:{doctors:{type:Array,required:!1,default:[]}},setup(u){const h=u,d=f({terms:!1});return(r,M)=>(i(),c(_,null,[t(o(p),{title:"Doctors"}),t(g,null,{default:a(()=>[s("div",x,[s("div",D,[s("div",N,[s("div",$,[s("div",j,[t(m,{href:r.route("doctor.create")},{default:a(()=>[k]),_:1},8,["href"])]),s("div",B,[s("ul",F,[(i(!0),c(_,null,b(h.doctors,e=>(i(),c("li",{key:e.id,class:"doctor table-row"},[s("div",S,[s("h3",null,l(e.user.name),1)]),s("div",V,[s("h3",null,l(e.user.email),1)]),s("div",C,[s("h3",null,l(e.user.phone),1)]),s("div",E,[s("p",null,l(e.role),1)]),s("div",H,[s("div",q,[s("div",z,[t(m,{href:r.route("doctor.edit",e.id),class:"ml-4"},{default:a(()=>[A]),_:2},1032,["href"])]),s("form",{class:"doctor-delete",onSubmit:v(T=>o(d).delete(r.route("doctor.destroy",e.id)),["prevent"])},[t(y,{class:w(["ml-4",{"opacity-25":o(d).processing}]),disabled:o(d).processing},{default:a(()=>[L]),_:1},8,["class","disabled"])],40,I)])])]))),128))])])])])])])]),_:1})],64))}};export{R as default};
