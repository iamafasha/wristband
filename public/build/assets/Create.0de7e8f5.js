import{m as i,o as l,i as c,w as d,a as e,u as a,H as _,b as t,p as n,n as u,j as f}from"./app.fe44229a.js";import{_ as p}from"./Authenticated.3fec2ac5.js";import{_ as w}from"./Button.279437d4.js";import{_ as b,a as h}from"./Label.11e75e3d.js";import{_ as v}from"./ValidationErrors.6542eb3b.js";import"./ApplicationLogo.f0df9556.js";import"./plugin-vue_export-helper.21dcd24c.js";const x={class:"w-full flex justify-center"},V={class:"w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"},y=["onSubmit"],$={class:"flex items-center justify-end mt-4"},g=f(" Add "),z={__name:"Create",setup(N){const s=i({mac_address:"",terms:!1}),m=()=>{s.post(route("device.store"))};return(j,o)=>(l(),c(p,null,{default:d(()=>[e(a(_),{title:"Add Device"}),t("div",x,[t("div",V,[e(v,{class:"mb-4"}),t("form",{onSubmit:n(m,["prevent"])},[t("div",null,[e(b,{for:"mac_address",value:"Name"}),e(h,{id:"mac_address",type:"text",class:"mt-1 block w-full",modelValue:a(s).mac_address,"onUpdate:modelValue":o[0]||(o[0]=r=>a(s).mac_address=r),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"])]),t("div",$,[e(w,{class:u(["ml-4",{"opacity-25":a(s).processing}]),disabled:a(s).processing},{default:d(()=>[g]),_:1},8,["class","disabled"])])],40,y)])])]),_:1}))}};export{z as default};
