import type { UserType } from "~/types/user.type";

export default new (class AuthService {
  async login(user: UserType): Promise<boolean> {
    const { $axios } = useNuxtApp();
    const { data } = await $axios.post("api/users/login", {
      email: user.email,
      password: user.password,
    });
    const tokenCookie = useCookie("token");
    tokenCookie.value = data.token;

    return true;
  }

  async logout() {
    const { $axios, $userStore } = useNuxtApp();
    await $axios.post("api/users/logout");
    delete $axios.defaults.headers.common["Authorization"];

    const tokenCookie = useCookie("token");
    tokenCookie.value = null;

    $userStore.resetData();
  }

  async register(user: UserType) {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.post("api/users/register", user);
      const token = useCookie("token");
      token.value = data.token;

      return true;
    } catch (error) {
      return false;
    }
  }

  async checkEmailCode(code: string) {
    if (code.length !== 8) {
      return;
    }
    const { $axios } = useNuxtApp();
    return $axios.post("api/users/verify-code", {
      code,
    });
  }
})();
