// export const state = ({route}) => ({
//     page:this.route().path
// })

// export const getters = {
//   page (state) {
//     return this.page.substring(this.page.lastIndexOf('/')+1)
//   },
// }

// export const state = () => ({
//     // busy: false,
//     // loggedIn: false,
//     // user: null,
// })

export const state = () => ({
  auth: {},
  localStorage: {},
  notifications: {},
  validation: {},
});

export const getters = {
  authenticated(state) {
    return state.auth.loggedIn;
  },
  role(state) {
    return state.auth.user.role;
  },
  user(state) {
    return state.auth.user;
  },
  notifications(state) {
    return state.notifications;
  },
};

export const mutations = {
  SET_NOTIFICATIONS(state, notifications) {
    state.notifications = notifications;
  },
};

export const actions = {
  setNotifications({ commit }, notifications) {
    commit("SET_NOTIFICATIONS", notifications);
  },
};
