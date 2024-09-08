import { computed } from "vue";

export function useAvatar(props) {
    const avatar = props.auth.user.avatar;
    const providerId = props.auth.user.provider_id;

    const avatarUrl = computed(() => {
        if (providerId) {
            return avatar; // If providerId exists, return avatar directly (external URL)
        } else if (avatar) {
            return `/storage/avatars/${avatar}`; // If only avatar exists, use local storage path
        } else {
            return "/storage/avatars/avatar.png"; // Default avatar
        }
    });

    return { avatarUrl }
}