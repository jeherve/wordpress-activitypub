(()=>{"use strict";var e={20:(e,t,i)=>{var n=i(609),r=Symbol.for("react.element"),o=(Symbol.for("react.fragment"),Object.prototype.hasOwnProperty),a=n.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,l={key:!0,ref:!0,__self:!0,__source:!0};t.jsx=function(e,t,i){var n,c={},s=null,p=null;for(n in void 0!==i&&(s=""+i),void 0!==t.key&&(s=""+t.key),void 0!==t.ref&&(p=t.ref),t)o.call(t,n)&&!l.hasOwnProperty(n)&&(c[n]=t[n]);if(e&&e.defaultProps)for(n in t=e.defaultProps)void 0===c[n]&&(c[n]=t[n]);return{$$typeof:r,type:e,key:s,ref:p,props:c,_owner:a.current}}},848:(e,t,i)=>{e.exports=i(20)},609:e=>{e.exports=window.React}},t={};function i(n){var r=t[n];if(void 0!==r)return r.exports;var o=t[n]={exports:{}};return e[n](o,o.exports,i),o.exports}var n=i(609);const r=window.wp.editor,o=window.wp.plugins,a=window.wp.components,l=window.wp.element,c=(0,l.forwardRef)((function({icon:e,size:t=24,...i},n){return(0,l.cloneElement)(e,{width:t,height:t,...i,ref:n})})),s=window.wp.primitives;var p=i(848);const u=(0,p.jsx)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,p.jsx)(s.Path,{d:"M12 3.3c-4.8 0-8.8 3.9-8.8 8.8 0 4.8 3.9 8.8 8.8 8.8 4.8 0 8.8-3.9 8.8-8.8s-4-8.8-8.8-8.8zm6.5 5.5h-2.6C15.4 7.3 14.8 6 14 5c2 .6 3.6 2 4.5 3.8zm.7 3.2c0 .6-.1 1.2-.2 1.8h-2.9c.1-.6.1-1.2.1-1.8s-.1-1.2-.1-1.8H19c.2.6.2 1.2.2 1.8zM12 18.7c-1-.7-1.8-1.9-2.3-3.5h4.6c-.5 1.6-1.3 2.9-2.3 3.5zm-2.6-4.9c-.1-.6-.1-1.1-.1-1.8 0-.6.1-1.2.1-1.8h5.2c.1.6.1 1.1.1 1.8s-.1 1.2-.1 1.8H9.4zM4.8 12c0-.6.1-1.2.2-1.8h2.9c-.1.6-.1 1.2-.1 1.8 0 .6.1 1.2.1 1.8H5c-.2-.6-.2-1.2-.2-1.8zM12 5.3c1 .7 1.8 1.9 2.3 3.5H9.7c.5-1.6 1.3-2.9 2.3-3.5zM10 5c-.8 1-1.4 2.3-1.8 3.8H5.5C6.4 7 8 5.6 10 5zM5.5 15.3h2.6c.4 1.5 1 2.8 1.8 3.7-1.8-.6-3.5-2-4.4-3.7zM14 19c.8-1 1.4-2.2 1.8-3.7h2.6C17.6 17 16 18.4 14 19z"})}),v=(0,p.jsx)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,p.jsx)(s.Path,{d:"M15.5 9.5a1 1 0 100-2 1 1 0 000 2zm0 1.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm-2.25 6v-2a2.75 2.75 0 00-2.75-2.75h-4A2.75 2.75 0 003.75 15v2h1.5v-2c0-.69.56-1.25 1.25-1.25h4c.69 0 1.25.56 1.25 1.25v2h1.5zm7-2v2h-1.5v-2c0-.69-.56-1.25-1.25-1.25H15v-1.5h2.5A2.75 2.75 0 0120.25 15zM9.5 8.5a1 1 0 11-2 0 1 1 0 012 0zm1.5 0a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z",fillRule:"evenodd"})}),w=(0,p.jsx)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,p.jsx)(s.Path,{fillRule:"evenodd",clipRule:"evenodd",d:"M12 18.5A6.5 6.5 0 0 1 6.93 7.931l9.139 9.138A6.473 6.473 0 0 1 12 18.5Zm5.123-2.498a6.5 6.5 0 0 0-9.124-9.124l9.124 9.124ZM4 12a8 8 0 1 1 16 0 8 8 0 0 1-16 0Z"})}),d=(0,p.jsx)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,p.jsx)(s.Path,{d:"M19.5 4.5h-7V6h4.44l-5.97 5.97 1.06 1.06L18 7.06v4.44h1.5v-7Zm-13 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-3H17v3a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h3V5.5h-3Z"})}),h=window.wp.data,_=window.wp.coreData,y=window.wp.url,b=window.wp.i18n;(0,o.registerPlugin)("activitypub-editor-plugin",{render:()=>{const e=(0,h.useSelect)((e=>e("core/editor").getCurrentPostType()),[]),[t,i]=(0,_.useEntityProp)("postType",e,"meta"),o={verticalAlign:"middle",gap:"4px",justifyContent:"start",display:"inline-flex",alignItems:"center"},l=(e,t)=>(0,n.createElement)(a.__experimentalText,{style:o},(0,n.createElement)(c,{icon:t}),e);return(0,n.createElement)(r.PluginDocumentSettingPanel,{name:"activitypub",title:(0,b.__)("⁂ Fediverse","activitypub")},(0,n.createElement)(a.TextControl,{label:(0,b.__)("Content Warning","activitypub"),value:t?.activitypub_content_warning,onChange:e=>{i({...t,activitypub_content_warning:e})},placeholder:(0,b.__)("Optional content warning","activitypub"),help:(0,b.__)("Content warnings do not change the content on your site, only in the fediverse.","activitypub")}),(0,n.createElement)(a.RadioControl,{label:(0,b.__)("Visibility","activitypub"),help:(0,b.__)("This adjusts the visibility of a post in the fediverse, but note that it won't affect how the post appears on the blog.","activitypub"),selected:t.activitypub_content_visibility?t.activitypub_content_visibility:"public",options:[{label:l((0,b.__)("Public","activitypub"),u),value:"public"},{label:l((0,b.__)("Quiet public","activitypub"),v),value:"quiet_public"},{label:l((0,b.__)("Do not federate","activitypub"),w),value:"local"}],onChange:e=>{i({...t,activitypub_content_visibility:e})},className:"activitypub-visibility"}))}}),(0,o.registerPlugin)("activitypub-editor-preview",{render:()=>{const e=(0,h.useSelect)((e=>e("core/editor").getCurrentPost().status));return(0,n.createElement)(n.Fragment,null,r.PluginPreviewMenuItem?(0,n.createElement)(r.PluginPreviewMenuItem,{onClick:()=>function(){const e=(0,h.select)("core/editor").getEditedPostPreviewLink(),t=(0,y.addQueryArgs)(e,{activitypub:"true"});window.open(t,"_blank")}(),icon:d,disabled:"auto-draft"===e},(0,b.__)("⁂ Fediverse preview","activitypub")):null)}})})();