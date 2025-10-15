export function formatDateForInput(dateString: string) {
  const date = new Date(dateString);
  return date.toISOString().slice(0, 16);
}
