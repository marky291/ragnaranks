(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{gakF:function(t,a,r){"use strict";r.r(a);var e=r("4HBT"),n={components:{"has-error":e.HasError,"alert-error":e.AlertError},mounted:function(){this.sendProfileAvatar()},data:function(){return{form:new e.Form({username:this.$parent.account.username,email:this.$parent.account.email,avatarUrl:this.$parent.account.avatarUrl})}},methods:{sendProfileAvatar:function(){this.$parent.setAvatar(this.form.avatarUrl)},saveAccount:function(){var t=this;this.form.post("/account/update").then(function(a){t.$Message.success("Changes to your account saved")}).catch(function(a){422!=a.status&&t.$Message.error(error.message)})}}},o=r("KHd+"),s=Object(o.a)(n,void 0,void 0,!1,null,null,null);a.default=s.exports}}]);