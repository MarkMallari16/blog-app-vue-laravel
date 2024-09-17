import { computed } from "vue";

export function useAvatar(avatar) {

    const avatarUrl = computed(() => {
        if (avatar && avatar.startsWith("https://avatars.githubusercontent.com/u/")) {
            return avatar;
        } else if (avatar) {
            return `/storage/avatars/${avatar}`
        } else {
            return "/storage/avatars/avatar.png";
        }
    });

    return { avatarUrl }
}