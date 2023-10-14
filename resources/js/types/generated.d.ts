declare namespace App.Data {
    export type MediaData = {
        id: number | null;
        file_name: string | null;
        name: string | null;
        mime_type: string | null;
        original_url: string | null;
        preview_url: string | null;
        size: number | null;
        custom_properties: Array<any> | null;
        responsive_images: App.Data.ResponsiveImageData | Array<any> | null;
        srcsets: string | null;
    };
    export type MediaLibraryOriginalData = {
        base64svg: string | null;
        urls: Array<any> | null;
    };
    export type ResponsiveImageData = {
        media_library_original: App.Data.MediaLibraryOriginalData | null;
    };
    export type RoleData = {
        id: number | null;
        name: string | null;
    };
    export type UserData = {
        id: number | null;
        name: string | null;
        email: string | null;
        role: any | App.Data.RoleData | null;
        logo: App.Data.MediaData | null;
    };
}
