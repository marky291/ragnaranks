(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{Zoux:function(a,r,t){"use strict";t.r(r);var o=t("4HBT"),s={components:{"has-error":o.HasError,"alert-error":o.AlertError},data:function(){return{form:new o.Form({username:"",email:"",password:"",password_confirmation:"",avatarUrl:"http://www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg"})}},methods:{attemptRegister:function(){var a=this;this.form.post("/register").then(function(a){window.location="/"}).catch(function(r){302===r.status&&(window.location="/"),a.$Message.error(r.message)})}}},e=t("KHd+"),n=Object(e.a)(s,void 0,void 0,!1,null,null,null);r.default=n.exports}}]);