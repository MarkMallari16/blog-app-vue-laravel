import { computed } from "vue";

export function useAvatar(avatar, providerId) {

    const avatarUrl = computed(() => {
        if (providerId) {
            return avatar;
        } else if (avatar) {
            return `/storage/avatars/${avatar}`;
        } else {
            return "/storage/avatars/avatar.png";
        }
    });

    return { avatarUrl }
}