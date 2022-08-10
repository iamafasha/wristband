import{f as g,h as x,x as w,u as s,o as n,c as u,y,m as v,i as f,w as m,a as r,H as V,t as p,k as c,b as l,L as $,n as B,p as C,j as b}from"./app.0a679d37.js";import{_ as L}from"./Button.1dbb187d.js";import{_ as N}from"./Guest.b7a4fddb.js";import{_,a as h}from"./Label.0be451e5.js";import{_ as R}from"./ValidationErrors.c9d9f312.js";import"./ApplicationLogo.fbcf624d.js";import"./plugin-vue_export-helper.21dcd24c.js";const S=["value"],U={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null}},emits:["update:checked"],setup(o,{emit:e}){const d=o,i=g({get(){return d.checked},set(t){e("update:checked",t)}});return(t,a)=>x((n(),u("input",{type:"checkbox",value:o.value,"onUpdate:modelValue":a[0]||(a[0]=k=>y(i)?i.value=k:null),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,8,S)),[[w,s(i)]])}},j={key:0,class:"mb-4 font-medium text-sm text-green-600"},q={key:1,class:"mb-4 font-medium text-sm text-red-600"},F=["onSubmit"],P={class:"mt-4"},D={class:"block mt-4"},E={class:"flex items-center"},H=l("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),M={class:"flex items-center justify-end mt-4"},z=b(" Forgot your password? "),A=b(" Log in "),W={__name:"Login",props:{canResetPassword:Boolean,status:String,flash:Object},setup(o){const e=v({email:"",password:"",remember:!1}),d=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})};return(i,t)=>(n(),f(N,null,{default:m(()=>[r(s(V),{title:"Log in"}),r(R,{class:"mb-4"}),o.status?(n(),u("div",j,p(o.status),1)):c("",!0),o.flash.error?(n(),u("div",q,p(o.flash.error),1)):c("",!0),l("form",{onSubmit:C(d,["prevent"])},[l("div",null,[r(_,{for:"email",value:"Email"}),r(h,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":t[0]||(t[0]=a=>s(e).email=a),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"])]),l("div",P,[r(_,{for:"password",value:"Password"}),r(h,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":t[1]||(t[1]=a=>s(e).password=a),required:"",autocomplete:"current-password"},null,8,["modelValue"])]),l("div",D,[l("label",E,[r(U,{name:"remember",checked:s(e).remember,"onUpdate:checked":t[2]||(t[2]=a=>s(e).remember=a)},null,8,["checked"]),H])]),l("div",M,[o.canResetPassword?(n(),f(s($),{key:0,href:i.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:m(()=>[z]),_:1},8,["href"])):c("",!0),r(L,{class:B(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:m(()=>[A]),_:1},8,["class","disabled"])])],40,F)]),_:1}))}};export{W as default};