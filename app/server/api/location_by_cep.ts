import axiosServer from "../services/axiosServer";

export default defineEventHandler(async (event) => {
  const { search } = getQuery(event);
  const { apiCEP } = axiosServer();

  const { data } = await apiCEP.get("/json/" + search);

  return {
    data,
  };
});
