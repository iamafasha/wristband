import{f as V,m as b,A as g,o as m,i as k,w as i,a,u as s,H as C,b as t,h as c,B as _,p as U,c as f,k as h,n as N,j as r}from"./app.fe44229a.js";import{_ as B}from"./Authenticated.3fec2ac5.js";import{_ as $}from"./Button.279437d4.js";import{_ as n,a as u}from"./Label.11e75e3d.js";import{_ as j}from"./ValidationErrors.6542eb3b.js";import"./ApplicationLogo.f0df9556.js";import"./plugin-vue_export-helper.21dcd24c.js";const q={class:"w-full flex flex-col items-center justify-center"},E={class:"w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mb-2"},S=t("h2",null,"Choose if user is an existing user",-1),A={class:"flex mt-5"},D=r(" Existing User "),F=r(" New User "),H={class:"w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md sm:rounded-lg"},M=["onSubmit"],P={key:0},T=t("h2",null,"Select a user",-1),z={class:"mt-4"},R={key:1},G=t("h2",null,"Patient Bio Data",-1),I={class:"mt-4"},J={class:"mt-4"},K={class:"flex items-center justify-end mt-4"},L=r(" Continue "),se={__name:"AddContact",props:["users","patient"],setup(v){const p=v,w=V(()=>p.users.map(d=>({label:d.name,value:d.id}))),e=b({user_type:"existing",selected_user:null,name:"",email:"",phone:"",terms:!1}),y=()=>{e.post(route("patient.contact.store",p.patient.id),{onFinish:()=>e.reset("password")})};return(d,l)=>{const x=g("v-select");return m(),k(B,null,{default:i(()=>[a(s(C),{title:"patient Create"}),t("div",q,[t("div",E,[S,t("div",A,[a(n,{class:"w-1/2"},{default:i(()=>[c(t("input",{type:"radio",name:"user_type",value:"existing","onUpdate:modelValue":l[0]||(l[0]=o=>s(e).user_type=o),checked:""},null,512),[[_,s(e).user_type]]),D]),_:1}),a(n,{class:"w-1/2"},{default:i(()=>[c(t("input",{type:"radio",name:"user_type",value:"new","onUpdate:modelValue":l[1]||(l[1]=o=>s(e).user_type=o)},null,512),[[_,s(e).user_type]]),F]),_:1})])]),t("div",H,[a(j,{class:"mb-4"}),t("form",{onSubmit:U(y,["prevent"])},[s(e).user_type=="existing"?(m(),f("div",P,[T,t("div",z,[a(x,{options:s(w),reduce:o=>o.value,modelValue:s(e).selected_user,"onUpdate:modelValue":l[2]||(l[2]=o=>s(e).selected_user=o),placeholder:"Type a name here"},null,8,["options","reduce","modelValue"])])])):h("",!0),s(e).user_type=="new"?(m(),f("div",R,[G,t("div",null,[a(n,{for:"name",value:"Name"}),a(u,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":l[3]||(l[3]=o=>s(e).name=o),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"])]),t("div",I,[a(n,{for:"email",value:"Email"}),a(u,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":l[4]||(l[4]=o=>s(e).email=o),required:"",autocomplete:"username"},null,8,["modelValue"])]),t("div",J,[a(n,{for:"phone_number",value:"Phone Number"}),a(u,{id:"phone",type:"text",class:"mt-1 block w-full",modelValue:s(e).phone,"onUpdate:modelValue":l[5]||(l[5]=o=>s(e).phone=o),required:"",autocomplete:"phone"},null,8,["modelValue"])])])):h("",!0),t("div",K,[a($,{class:N(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:i(()=>[L]),_:1},8,["class","disabled"])])],40,M)])])]),_:1})}}};export{se as default};
