export function formatDate(dateString: string) {
  return new Date(dateString).toLocaleDateString("pt-BR");
}
