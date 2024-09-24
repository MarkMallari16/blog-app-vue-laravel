export function useDate(date) {
    const formattedDate = new Intl.DateTimeFormat("eng-EN", {
        year: "numeric",
        month: "short",
        day: "numeric"
    }).format(new Date(date));

    return { formattedDate };
}