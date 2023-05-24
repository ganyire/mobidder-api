export type RoleName = "super-admin" | "vendor" | "customer" | "vendor-admin";

type Role = {
    name: RoleName;
    display_name: string;
};
type DateTime = { for_human: string; for_machine: string };

type Attributes = {
    id: string;
    email: string;
    name: string;
    phone: string;
    emailIsVerified: boolean;
    accountIsLocked: boolean;
    created_at: DateTime;
};

type Relationships = {
    role: Role;
};

interface User {
    attributes: Attributes;
    relationships: Relationships;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: { data: User };
    error: string;
    success: string;
};
