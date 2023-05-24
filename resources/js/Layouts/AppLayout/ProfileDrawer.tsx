import { FC, ReactNode } from "react";
import { Drawer } from "antd";
import useDrawerStore from "@/store/drawerStore";

interface Props {
    title: ReactNode;
}

const ProfileDrawer: FC<Props> = (props) => {
    const { title } = props;

    const { profileDrawerIsOpen, closeProfileDrawer } = useDrawerStore();

    return (
        <Drawer
            title={title}
            placement="right"
            open={profileDrawerIsOpen}
            onClose={closeProfileDrawer}
            width={600}
        ></Drawer>
    );
};

export default ProfileDrawer;
