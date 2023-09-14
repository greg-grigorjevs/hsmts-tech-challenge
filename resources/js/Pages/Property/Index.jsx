import React from 'react';
import { Link } from '@inertiajs/react'


export default function Index({ properties, create_url }) {
    const { data, links } = properties

    return (
        <>
            <div className="overflow-x-auto bg-white rounded shadow">
                <table className="w-full whitespace-nowrap divide-y divide-gray-200 ">
                    <thead>
                        <tr className="font-bold text-left">
                            <th className="px-6 pt-5 pb-4">Name</th>
                            <th className="px-6 pt-5 pb-4">Address</th>
                            <th className="px-4">
                                <span className="sr-only">Edit</span>
                            </th>
                            <th className="px-4">
                                <span className="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {data.map(({ id, name, address, edit_url, delete_url }) => {
                            return (
                                <tr key={id} className="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td className="border-t">
                                        {name}
                                    </td>
                                    <td className="border-t">
                                        {address}
                                    </td>
                                    <td className="border-t">
                                        <Link href={edit_url} method="get">Edit</Link>
                                    </td>
                                    <td className="border-t">
                                        <Link href={delete_url} method="delete" as="button">Delete</Link>
                                    </td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>
            </div>
                <Link href={create_url} as="button" className="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add Property</Link>

        </>
    )
}
