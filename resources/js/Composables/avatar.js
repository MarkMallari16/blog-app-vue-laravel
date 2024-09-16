import { computed } from "vue";

export function useAvatar(avatar) {

    const avatarUrl = computed(() => {
        if (avatar) {
            return avatar.startsWith("/storage/avatars/") ? `/storage/avatars/${avatar}` : avatar;
        } else {
            return "/storage/avatars/avatar.png";
        }
    });

    return { avatarUrl }
}