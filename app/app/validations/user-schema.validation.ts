import { z } from "zod";

const loginSchema = z.object({
  email: z.string().email(),
  password: z.string().min(6),
});

const registerSchema = z
  .object({
    name: z.string().min(1),
    email: z.string().email(),
    password: z.string().min(6),
    password_confirmation: z.string(),
  })
  .refine((data) => data.password === data.password_confirmation, {
    path: ["password_confirmation"],
  });

export { loginSchema, registerSchema };
