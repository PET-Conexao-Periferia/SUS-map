export function validateEndDate(value: string, startTime?: string) {
  if (!value) return false;
  if (!startTime) return true;
  return new Date(value) > new Date(startTime);
}
