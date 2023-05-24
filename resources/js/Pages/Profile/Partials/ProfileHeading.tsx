import React, { FC, ReactNode } from "react";

interface Props {
    children: ReactNode;
}

const ProfileHeading: FC<Props> = (props) => {
    const { children } = props;

    return (
        <h1 className="text-2xl bg-clip-text text-transparent bg-gradient-to-r from-secondary via-yellow-700 to-accent">
            {children}
        </h1>
    );
};

export default ProfileHeading;
