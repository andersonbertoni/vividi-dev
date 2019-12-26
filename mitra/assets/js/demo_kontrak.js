!function (e) {
    var t = {};

    function n(o) {
        if (t[o]) return t[o].exports;
        var r = t[o] = {i: o, l: !1, exports: {}};
        return e[o].call(r.exports, r, r.exports, n), r.l = !0, r.exports
    }

    n.m = e, n.c = t, n.d = function (e, t, o) {
        n.o(e, t) || Object.defineProperty(e, t, {enumerable: !0, get: o})
    }, n.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
    }, n.t = function (e, t) {
        if (1 & t && (e = n(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var o = Object.create(null);
        if (n.r(o), Object.defineProperty(o, "default", {
            enumerable: !0,
            value: e
        }), 2 & t && "string" != typeof e) for (var r in e) n.d(o, r, function (t) {
            return e[t]
        }.bind(null, r));
        return o
    }, n.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return n.d(t, "a", t), t
    }, n.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, n.p = "", n(n.s = 1)
}([, function (e, t, n) {
    "use strict";
    Object.defineProperty(t, "__esModule", {value: !0});
    const o = n(2), r = new Date, a = {
        element: document.getElementById("litepicker"),
        elementEnd: null,
        parentEl: document.getElementById("demo-preview-sticky"),
        firstDay: 1,
        format: "D MMM, YYYY",
        lang: "en-US",
        numberOfMonths: 1,
        numberOfColumns: 1,
        startDate: null,
        endDate: null,
        zIndex: 9999,
        minDate: new Date(r.getFullYear(), r.getMonth(), r.getDate()),
        maxDate: null,
        minDays: 1,
        maxDays: null,
        selectForward: 1,
        selectBackward: !1,
        splitView: !1,
        inlineMode: 0,
        singleMode: !1,
        autoApply: !0,
        allowRepick: !1,
        showWeekNumbers: !1,
        showTooltip: !0,
        hotelMode: !1,
        disableWeekends: !1,
        scrollToDate: !0,
        mobileFriendly: !0,
        lockDaysFormat: "YYYY-MM-DD",
        lockDays: [],
        disallowLockDaysInRange: !1,
        bookedDaysFormat: "YYYY-MM-DD",
        bookedDays: [],
        buttonText: {
            apply: "Apply",
            cancel: "Cancel",
            previousMonth: '<svg width="11" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M7.919 0l2.748 2.667L5.333 8l5.334 5.333L7.919 16 0 8z" fill-rule="nonzero"/></svg>',
            nextMonth: '<svg width="11" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M2.748 16L0 13.333 5.333 8 0 2.667 2.748 0l7.919 8z" fill-rule="nonzero"/></svg>'
        },
        tooltipText: {one: "day", other: "days"},
        onShow: function () {
            console.log("onShow callback")
        },
        onHide: function () {
            console.log("onHide callback")
        },
        onSelect: function (e, t) {
            console.log("onSelect callback", e, t)
        },
        onError: function (e) {
            console.log("onError callback", e)
        },
        onChangeMonth: function (e, t) {
            console.log("onChangeMonth callback", e, t)
        },
        onChangeYear: function (e) {
            console.log("onChangeYear callback", e)
        }
    };
    let c, i = {
        set: function (e, t, n) {
            switch (e[t] = n, t) {
                case"singleMode":
                    if (n) e.endDate = null; else {
                        let t = new Date(e.startDate);
                        e.endDate = new Date(t.getFullYear(), t.getMonth(), t.getDate() + 7)
                    }
                    break;
                case"lang":
                    switch (n) {
                        case"ru-RU":
                            e.tooltipText = {one: "день", few: "дня", many: "дней"};
                            break;
                        case"de-DE":
                            e.tooltipText = {one: "tag", other: "tage"};
                            break;
                        case"ja-JP":
                            e.tooltipText = {one: "日", other: "日間"};
                            break;
                        default:
                            e.tooltipText = {one: "day", other: "days"}
                    }
                    break;
                case"minDate":
                    if (e.startDate && e.startDate.getTime() < n.getTime() && (e.startDate = n), e.endDate && e.endDate.getTime() < n.getTime()) {
                        let t = new Date(n);
                        t.setDate(n.getDate() + 7), e.endDate = new Date(t)
                    }
                    break;
                case"maxDate":
                    if (e.startDate && e.startDate.getTime() > n.getTime()) {
                        e.startDate = n;
                        let t = new Date(n);
                        t.setDate(n.getDate() + 7), e.endDate = new Date(t)
                    }
                    e.endDate && e.endDate.getTime() > n.getTime() && (e.endDate = n)
            }
            if (e.startDate && e.endDate && e.startDate.getTime() > e.endDate.getTime()) {
                let t = new Date(e.startDate);
                e.startDate = new Date(e.endDate), e.endDate = new Date(t)
            }
            switch (s.setOptions(e), t) {
                case"inlineMode":
                    n || s.hide()
            }
            return !0
        }
    };
    if (window.Proxy) c = new Proxy(a, i); else {
        const e = o.default();
        c = new e(a, i)
    }
    const l = document.getElementById("picker-options"), s = new Litepicker(c), u = (e, t, n = null, o = null) => {
        const r = document.createElement("input");
        r.type = "number", r.className = "number-switch", r.value = c[t], null !== n && (r.min = n), null !== o && (r.max = o), r.addEventListener("change", (function () {
            c[t] = Number(r.value), this.closest(".picker-option-item").querySelector("code").innerHTML = r.value
        })), r.addEventListener("keydown", e => {
            e.preventDefault()
        }), e.innerHTML = `<code>${c[t]}</code><label>,</label>`;
        const a = document.createElement("div");
        a.className = "user-value-container", a.appendChild(r), e.appendChild(a)
    }, d = (e, t, n) => {
        const o = document.createElement("select");
        for (var r = 0; r < n.length; r += 1) {
            const e = document.createElement("option");
            e.value = n[r], e.text = n[r], o.appendChild(e)
        }
        const a = document.createElement("option");
        a.text = "etc ...", a.disabled = !0, o.appendChild(a), o.value = n[n.indexOf(c[t])], o.addEventListener("change", () => {
            const n = o.options[o.selectedIndex].value;
            c[t] = n, e.closest(".picker-option-item").querySelector("code").innerHTML = `'${n}'`
        }), e.innerHTML = `<code>'${c[t]}'</code><label>,</label>`;
        const i = document.createElement("div");
        i.className = "user-value-container", i.appendChild(o), e.appendChild(i)
    };
    Object.keys(c).forEach(e => {
        const t = document.createElement("div");
        t.className = "picker-option-item";
        const n = document.createElement("label");
        n.innerHTML = `${e}:`;
        const o = document.createElement("div");
        switch (e) {
            case"firstDay":
                u(o, e, 0, 6);
                break;
            case"format":
                d(o, e, ["YYYY-MM-DD", "DD/MM/YYYY", "D MMM, YYYY"]);
                break;
            case"lang":
                d(o, e, ["en-US", "ru-RU", "de-DE", "ja-JP"]);
                break;
            case"numberOfMonths":
                u(o, e, 1);
                break;
            case"numberOfColumns":
                u(o, e, 1, 4);
                break;
            case"selectForward":
            case"selectBackward":
            case"splitView":
            case"inlineMode":
            case"singleMode":
            case"autoApply":
            case"showWeekNumbers":
            case"showTooltip":
            case"disableWeekends":
            case"mobileFriendly":
                ((e, t) => {
                    const n = document.createElement("input");
                    n.type = "checkbox", n.className = "apple-switch", n.checked = c[t], n.addEventListener("change", () => {
                        c[t] = n.checked, e.closest(".picker-option-item").querySelector("code").innerHTML = Boolean(n.checked)
                    }), e.innerHTML = `<code>${Boolean(c[t])}</code><label>,</label>`;
                    const o = document.createElement("div");
                    o.className = "user-value-container", o.appendChild(n), e.appendChild(o)
                })(o, e);
                break;
            case"minDate":
            case"maxDate":
                ((e, t) => {
                    const n = document.createElement("button");
                    n.className = "calendar-icon", new Litepicker({
                        element: n, onSelect: function (n) {
                            c[t] = n, e.closest(".picker-option-item").querySelector("code").innerHTML = `'${n.toDateString()}'`
                        }
                    }), e.innerHTML = `<code>${c[t]}</code><label>,</label>`;
                    const o = document.createElement("div");
                    o.className = "user-value-container", o.appendChild(n), e.appendChild(o)
                })(o, e);
                break;
            case"minDays":
            case"maxDays":
                u(o, e, 0)
        }
        o.innerHTML.length && (t.appendChild(n), t.appendChild(o), l.appendChild(t))
    })
}, function (e, t, n) {
    (function (e, t) {
        var n;
        (n = void 0 !== e && "[object process]" === {}.toString.call(e) || "undefined" != typeof navigator && "ReactNative" === navigator.product ? t : self).Proxy || (n.Proxy = function () {
            function e(e) {
                return !!e && ("object" == typeof e || "function" == typeof e)
            }

            var t = null, n = function (n, o) {
                function r() {
                }

                if (!e(n) || !e(o)) throw new TypeError("Cannot create proxy with a non-object as target or handler");
                t = function () {
                    r = function (e) {
                        throw new TypeError("Cannot perform '" + e + "' on a proxy that has been revoked")
                    }
                };
                var a = o;
                for (var c in o = {get: null, set: null, apply: null, construct: null}, a) {
                    if (!(c in o)) throw new TypeError("Proxy polyfill does not support trap '" + c + "'");
                    o[c] = a[c]
                }
                "function" == typeof a && (o.apply = a.apply.bind(a));
                var i = this, l = !1, s = !1;
                "function" == typeof n ? (i = function () {
                    var e = this && this.constructor === i, t = Array.prototype.slice.call(arguments);
                    return r(e ? "construct" : "apply"), e && o.construct ? o.construct.call(this, n, t) : !e && o.apply ? o.apply(n, this, t) : e ? (t.unshift(n), new (n.bind.apply(n, t))) : n.apply(this, t)
                }, l = !0) : n instanceof Array && (i = [], s = !0);
                var u = o.get ? function (e) {
                    return r("get"), o.get(this, e, i)
                } : function (e) {
                    return r("get"), this[e]
                }, d = o.set ? function (e, t) {
                    r("set"), o.set(this, e, t, i)
                } : function (e, t) {
                    r("set"), this[e] = t
                }, p = {};
                if (Object.getOwnPropertyNames(n).forEach((function (e) {
                    if (!((l || s) && e in i)) {
                        var t = {
                            enumerable: !!Object.getOwnPropertyDescriptor(n, e).enumerable,
                            get: u.bind(n, e),
                            set: d.bind(n, e)
                        };
                        Object.defineProperty(i, e, t), p[e] = !0
                    }
                })), a = !0, Object.setPrototypeOf ? Object.setPrototypeOf(i, Object.getPrototypeOf(n)) : i.__proto__ ? i.__proto__ = n.__proto__ : a = !1, o.get || !a) for (var f in n) p[f] || Object.defineProperty(i, f, {get: u.bind(n, f)});
                return Object.seal(n), Object.seal(i), i
            };
            return n.revocable = function (e, o) {
                return {proxy: new n(e, o), revoke: t}
            }, n
        }(), n.Proxy.revocable = n.Proxy.revocable)
    }).call(this, n(3), n(4))
}, function (e, t) {
    var n, o, r = e.exports = {};

    function a() {
        throw new Error("setTimeout has not been defined")
    }

    function c() {
        throw new Error("clearTimeout has not been defined")
    }

    function i(e) {
        if (n === setTimeout) return setTimeout(e, 0);
        if ((n === a || !n) && setTimeout) return n = setTimeout, setTimeout(e, 0);
        try {
            return n(e, 0)
        } catch (t) {
            try {
                return n.call(null, e, 0)
            } catch (t) {
                return n.call(this, e, 0)
            }
        }
    }

    !function () {
        try {
            n = "function" == typeof setTimeout ? setTimeout : a
        } catch (e) {
            n = a
        }
        try {
            o = "function" == typeof clearTimeout ? clearTimeout : c
        } catch (e) {
            o = c
        }
    }();
    var l, s = [], u = !1, d = -1;

    function p() {
        u && l && (u = !1, l.length ? s = l.concat(s) : d = -1, s.length && f())
    }

    function f() {
        if (!u) {
            var e = i(p);
            u = !0;
            for (var t = s.length; t;) {
                for (l = s, s = []; ++d < t;) l && l[d].run();
                d = -1, t = s.length
            }
            l = null, u = !1, function (e) {
                if (o === clearTimeout) return clearTimeout(e);
                if ((o === c || !o) && clearTimeout) return o = clearTimeout, clearTimeout(e);
                try {
                    o(e)
                } catch (t) {
                    try {
                        return o.call(null, e)
                    } catch (t) {
                        return o.call(this, e)
                    }
                }
            }(e)
        }
    }

    function m(e, t) {
        this.fun = e, this.array = t
    }

    function h() {
    }

    r.nextTick = function (e) {
        var t = new Array(arguments.length - 1);
        if (arguments.length > 1) for (var n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
        s.push(new m(e, t)), 1 !== s.length || u || i(f)
    }, m.prototype.run = function () {
        this.fun.apply(null, this.array)
    }, r.title = "browser", r.browser = !0, r.env = {}, r.argv = [], r.version = "", r.versions = {}, r.on = h, r.addListener = h, r.once = h, r.off = h, r.removeListener = h, r.removeAllListeners = h, r.emit = h, r.prependListener = h, r.prependOnceListener = h, r.listeners = function (e) {
        return []
    }, r.binding = function (e) {
        throw new Error("process.binding is not supported")
    }, r.cwd = function () {
        return "/"
    }, r.chdir = function (e) {
        throw new Error("process.chdir is not supported")
    }, r.umask = function () {
        return 0
    }
}, function (e, t) {
    var n;
    n = function () {
        return this
    }();
    try {
        n = n || new Function("return this")()
    } catch (e) {
        "object" == typeof window && (n = window)
    }
    e.exports = n
}]);