import {createRouter, createWebHistory} from "vue-router";
import axios from "axios";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/users/index",
            component: () => import("../views/user/Index.vue"),
            name: 'user.index',
        }, {
            path: "/users/:id",
            component: () => import("../views/user/Show.vue"),
            name: 'user.show',
        }, {
            path: "/page",
            component: () => import("../views/Page.vue"),
        },
        {
            path: "/users/login",
            component: () => import("../views/user/Login.vue"),
            name: "user.login",
        },
        {
            path: "/users/registration",
            component: () => import("../views/user/Registration.vue"),
            name: "user.registration",
        },
        {
            path: "/users/personal",
            component: () => import("../views/user/Personal.vue"),
            name: "user.personal",
        },
    ],
});

router.beforeEach(async (to, from, next) => {
    let token = localStorage.getItem("x_xsrf_token");

    if (token) {
        try {
            await axios.get("/api/user", {
                headers: {Authorization: `Bearer ${token}`},
            });
        } catch (e) {
            if (e.response && e.response.status === 401) {
                localStorage.removeItem("x_xsrf_token");
                token = null;
            }
        }
    }

    if (!token) {
        if (to.name === "user.login" || to.name === "user.registration") {
            return next();
        }
        return next({name: "user.login"}); // Исправленный путь
    }

    if (to.name === "user.login" || to.name === "user.registration") {
        return next({name: "user.personal"});
    }

    next();
});

export default router;
