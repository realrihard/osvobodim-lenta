import{_ as b,r as h,o as $,a as v,b as _,c as p,d as t,t as g,F as B,e as r,f as F,g as N,h as D,i as O,j,k as L,l as R,s as k,m as G,n as q,u as C,p as J,q as Q,w as V,v as X,x as Y,y as M}from"./_plugin-vue_export-helper-0a7ba489.js";const T="/build/assets/frame-a5c83d5a.png",W={setup(){const o=h({mainsum:null,day7:null,day30:null,clients:null});$(()=>{n(),l(),s(),a()});const n=async()=>{try{o.value.mainsum=await v.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=I2:J2&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82").then(e=>e.data.trim())}catch(e){return console.error(e),null}},l=async()=>{try{o.value.day7=await v.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=M1:N1&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82").then(e=>(console.log(e),e.data.trim()))}catch(e){return console.error(e),null}},s=async()=>{try{o.value.day30=await v.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=M2:N2&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82").then(e=>e.data.trim())}catch(e){return console.error(e),null}},a=async()=>{try{o.value.clients=await v.get("https://docs.google.com/spreadsheets/d/1hJ4SrLriOv_jUmjjo2qCsyz0GC15r_60LY9vlX2Q9L0/gviz/tq?tqx=out:csv&range=P1:Q1&sheet=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82").then(e=>e.data.trim())}catch(e){return console.error(e),null}};return{total:o,mainsum:n,day7:l,day30:s,kolvodel:a}}},K={class:"hero__content"},Z=t("div",{class:"hero__image"},[t("img",{src:T,alt:""})],-1),tt={class:"hero__info__wrapper"},et={class:"hero__info"},st={class:"hero__info__block"},ot={class:"hero__info__item"},nt=r("Сумма списанных задолженностей:"),at=t("br",null,null,-1),lt=r(),ct={class:"text_big text_action"},rt={class:"hero__info__item"},it=r("За последние 7 дней:"),_t=t("br",null,null,-1),dt=r(),ut={class:"text_middle text_blue"},pt={class:"hero__info__item"},mt=r("За последние 30 дней:"),ht=t("br",null,null,-1),vt=r(),gt={class:"text_middle text_blue"},yt={class:"hero__info__item"},ft=r("Клиентов освобождено:"),Dt=t("br",null,null,-1),Bt=r(),bt={class:"text_middle text_blue"},$t=t("div",{class:"hero__bottom",style:{"font-size":"24px"}},[t("p",null,[r("Листайте ниже чтобы ознакомиться"),t("br"),r(" с результатоми нашей работы")]),t("div",{class:"mouse"})],-1);function wt(o,n,l,s,a,e){return _(),p(B,null,[t("div",K,[Z,t("div",tt,[t("div",et,[t("div",st,[t("div",ot,[nt,at,lt,t("span",ct,g(s.total.mainsum),1)]),t("div",rt,[it,_t,dt,t("span",ut,g(s.total.day7),1)]),t("div",pt,[mt,ht,vt,t("span",gt,g(s.total.day30),1)]),t("div",yt,[ft,Dt,Bt,t("span",bt,g(s.total.clients),1)])])])])]),$t],64)}const xt=b(W,[["render",wt]]),St={props:{suma:{type:Number,default:null}},setup(o){return{formatedSuma:F(()=>o.suma.toLocaleString("ru-RU",{style:"currency",currency:"RUB",minimumFractionDigits:0}))}}},Lt={class:"stamp is_approved"},kt=r("Списано "),qt=t("br",null,null,-1);function Ct(o,n,l,s,a,e){return _(),p("div",Lt,[kt,qt,t("span",null,g(s.formatedSuma),1)])}const jt=b(St,[["render",Ct]]),zt={components:{Stamp:jt},setup(){const o=h(null),n=h(null),l=h(1),s=h(null),a=h(!1),e=h(null);$(async()=>{await v.get("/posts").then(u=>{n.value=u.data.posts,s.value=u.data.pagination.totalPages}),e.value=document.querySelector(".content"),e.value.addEventListener("scroll",d)}),N(()=>{e.value.removeEventListener("scroll",d)});const i=async()=>(l.value++,(await v.get("/posts?page="+l.value)).data.posts),c=async()=>{let u=await i(l.value);n.value.push(...u)},m=()=>{a.value=!0},d=()=>{const u=o.value.getBoundingClientRect(),f=e.value.offsetHeight;u.bottom-f-600<=0&&l.value<=s.value&&c()};return{scrollBlock:o,posts:n,currentPage:l,getPosts:i,imageLoaded:a,onImageLoad:m,scrollHandle:d}}},It={class:"gallery"},Nt=t("h3",{class:"block__title"},"Наши выигранные дела",-1),Ot={class:"gallery__item"},Pt={class:"gallery__item__image"},Ut=["src"],Et={key:0,class:"gallery__item__stamp"},Ht={key:0,class:"gallery__item__dascription"},At={key:0,class:"contact__form"},Ft=t("h4",null,[r("Хотите также?"),t("br"),r("Оставляйте заявку!")],-1),Rt=t("form",null,[t("input",{type:"text",placeholder:"Ваше имя"}),t("input",{type:"text",placeholder:"Ваш телефон"}),t("button",{type:"submit",class:"more__btn"},"Хочу также")],-1),Gt=[Ft,Rt];function Jt(o,n,l,s,a,e){const i=D("stamp");return _(),p("div",{class:"gallery__wrapper",ref:"scrollBlock",onScroll:n[1]||(n[1]=(...c)=>s.scrollHandle&&s.scrollHandle(...c))},[t("div",It,[Nt,(_(!0),p(B,null,O(s.posts,(c,m)=>(_(),p(B,{key:c.showId},[t("article",Ot,[t("div",Pt,[t("img",{src:"/images/"+c.image,onLoad:n[0]||(n[0]=(...d)=>s.onImageLoad&&s.onImageLoad(...d)),alt:""},null,40,Ut),c.suma&&s.imageLoaded?(_(),p("div",Et,[j(i,{suma:c.suma},null,8,["suma"])])):L("",!0)]),c.description?(_(),p("div",Ht,g(c.description),1)):L("",!0)]),(m+1)%8===0?(_(),p("div",At,Gt)):L("",!0)],64))),128))])],544)}const Qt=b(zt,[["render",Jt]]),Vt=R({__name:"Smoothie",props:{weight:{default:.06}},setup(o,{expose:n}){const l=o;let s=k(),a=k(),e=k(),i={overflow:"auto"},c={position:"sticky",top:0},m={willChange:"transform",position:"absolute",width:"100%"},d={el:s,y:0};n(d);let u,f=0,y=0;const U=()=>{({scrollTop:f}=s.value)},z=()=>{e.value.style.height=a.value.scrollHeight+"px"};let w=new ResizeObserver(z);return $(()=>{w.observe(a.value),z();let x=1e3/60,S=performance.now();requestAnimationFrame(function E(){u=requestAnimationFrame(E);let I=performance.now(),H=I-S;S=I;let A=l.weight*H/x;y+=A*(f-y),d.y=y,a.value.style.transform=`translate3D(0, ${-y}px, 0)`})}),G(()=>{w.observe(a.value)}),N(()=>{cancelAnimationFrame(u),w.disconnect()}),(x,S)=>(_(),p("div",{ref_key:"wrap",ref:s,onScroll:U,style:q(C(i))},[t("div",{style:q(C(c))},[t("div",{ref_key:"content",ref:a,style:q(C(m))},[J(x.$slots,"default")],4)],4),t("div",{ref_key:"spacer",ref:e},null,512)],36))}}),Xt="/build/assets/logo-dcdeb54c.svg";const Yt={components:{Hero:xt,Gallery:Qt,Smoothie:Vt},setup(){return $(()=>{const o=window.sessionStorage.getItem("scrollPosition");o&&window.scrollTo(0,parseInt(o))}),{}}},P=o=>(X("data-v-dad002b0"),o=o(),Y(),o),Mt={class:"hero"},Tt=P(()=>t("div",{class:"header"},[t("div",{class:"container"},[t("div",{class:"header__block"},[t("div",{class:"logo"},[t("img",{src:Xt})])])])],-1)),Wt=P(()=>t("div",{class:"bg__forms"},[t("div",{class:"circle_mid"}),t("div",{class:"circle_bg"})],-1)),Kt={class:"hero__wrapper"},Zt={class:"area"},te={class:"circles"},ee={class:"container"},se={class:"container"};function oe(o,n,l,s,a,e){const i=D("hero"),c=D("gallery"),m=D("Smoothie");return _(),Q(m,{class:"content"},{default:V(()=>[t("div",Mt,[Tt,Wt,t("div",Kt,[t("div",Zt,[t("ul",te,[(_(),p(B,null,O(10,d=>t("li",{key:d})),64))])]),t("div",ee,[j(i)])])]),t("div",se,[j(c)])]),_:1})}const ne=b(Yt,[["render",oe],["__scopeId","data-v-dad002b0"]]);M(ne).mount("#app");
