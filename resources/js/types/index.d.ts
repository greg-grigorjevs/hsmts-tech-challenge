export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export type Property = {
    id: number,
    name: string,
    address: string,
    edit_url?: string,
    delete_url?: string,
}

export type Room = {
    id: number
    name: string,
    size: string,
    edit_url?: string,
    delete_url?: string,
}

export type PaginateLink = {
    url: string;
    label: string;
    active: boolean;
};

export type Paginated<T = any> = {
    data: T[];
    current_page: number;
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginateLink[];
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url: string;
    to: number;
    total: number;
};

