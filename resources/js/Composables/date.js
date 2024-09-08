export function useDate(date) {
    const formattedDate = new Intl.DateTimeFormat("fil-PH", {
        year: "numeric",
        month: "short",
        day: "numeric"
    }).format(new Date(date));

    return { formattedDate };
}