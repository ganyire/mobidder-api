import { Avatar as AntAvatar, Dropdown, MenuProps, Badge } from "antd";
import { UserOutlined } from "@ant-design/icons";
import { router, usePage } from "@inertiajs/react";
import { PageProps } from "@/types";
import ProfileDrawer from "./ProfileDrawer";

const Avatar = () => {
    const { auth } = usePage<PageProps>().props;

    const items: MenuProps["items"] = [
        {
            key: 1,
            label: (
                <div className="flex flex-col">
                    <span className="font-bold">{auth.attributes?.name}</span>
                    <span>{auth?.attributes?.email}</span>
                </div>
            ),
            onClick: () => router.get(route("ui.profile")),
        },
    ];

    return (
        <>
            <Dropdown menu={{ items }} placement="bottomRight">
                <Badge dot>
                    <AntAvatar
                        className="bg-secondary-alternative flex items-center justify-center cursor-pointer "
                        size={40}
                        icon={<UserOutlined />}
                    />
                </Badge>
            </Dropdown>

            <ProfileDrawer title={auth?.attributes?.name} />
        </>
    );
};

export default Avatar;
