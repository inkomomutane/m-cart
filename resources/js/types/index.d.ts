
export interface PaginatedData {
    data: Array;
    links: Array;
    meta: {
        current_page?: number;
        first_page_url?: String;
        from?: Number;
        last_page?: number;
        last_page_url?: String;
        next_page_url?: String;
        path?: String;
        per_page?: Number;
        prev_page_url?: String;
        to?: Number;
        total?: Number;
    };
}

export enum FlahserType {
    success = "success",
    error = "error",
    warning = "warning",
    info = "info",
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: App.Data.UserData;
    };
    globals: App.Data.PageData;
    roles: {
        type: Array<App.Data.RoleData>;
    };
};
