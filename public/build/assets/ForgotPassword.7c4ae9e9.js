import{m as d,o as l,i as c,w as m,a as e,u as t,H as u,c as _,t as f,k as p,b as a,n as w,p as b,j as y}from"./app.fe44229a.js";import{_ as g}from"./Button.279437d4.js";import{_ as k}from"./Guest.00e5de25.js";import{_ as x,a as h}from"./Label.11e75e3d.js";import{_ as V}from"./ValidationErrors.6542eb3b.js";import"./ApplicationLogo.f0df9556.js";import"./plugin-vue_export-helper.21dcd24c.js";const v=a("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),N={key:0,class:"mb-4 font-medium text-sm text-green-600"},$=["onSubmit"],B={class:"flex items-center justify-end mt-4"},F=y(" Email Password Reset Link "),D={__name:"ForgotPassword",props:{status:String},setup(o){const s=d({email:""}),r=()=>{s.post(route("password.email"))};return(S,i)=>(l(),c(k,null,{default:m(()=>[e(t(u),{title:"Forgot Password"}),v,o.status?(l(),_("div",N,f(o.status),1)):p("",!0),e(V,{class:"mb-4"}),a("form",{onSubmit:b(r,["prevent"])},[a("div",null,[e(x,{for:"email",value:"Email"}),e(h,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:t(s).email,"onUpdate:modelValue":i[0]||(i[0]=n=>t(s).email=n),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"])]),a("div",B,[e(g,{class:w({"opacity-25":t(s).processing}),disabled:t(s).processing},{default:m(()=>[F]),_:1},8,["class","disabled"])])],40,$)]),_:1}))}};export{D as default};
