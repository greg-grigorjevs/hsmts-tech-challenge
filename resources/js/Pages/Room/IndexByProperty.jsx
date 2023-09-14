import React from 'react';
import { Link } from '@inertiajs/react'
import Pagination from '@/Shared/Pagination'


export default function IndexByPropety({ property, rooms, create_url }) {
    const { data, links } = rooms

    return (
        <>
            <div className="m-10 overflow-x-auto bg-white rounded shadow">
                <h1 className="font-medium text-3xl mb-5">Rooms at {property.name}</h1>
                <table className="border border-gray-300 w-full whitespace-nowrap divide-y divide-gray-200 mb-2 ">
                    <thead>
                        <tr className="font-bold text-left">
                            <th className="px-6 pt-5 pb-4">Name</th>
                            <th className="px-6 pt-5 pb-4">Size</th>
                            <th className="px-4">
                                <span className="sr-only">Edit</span>
                            </th>
                            <th className="px-4">
                                <span className="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {data.map(({ id, name, size, edit_url, delete_url }) => {
                            return (
                                <tr key={id} className="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td className="p-3 border-t">
                                        {name}
                                    </td>
                                    <td className="border-t">
                                        {size}
                                    </td>
                                    <td className="border-t">
                                        <Link href={edit_url} method="get" className="hover:text-yellow-800">Edit</Link>
                                    </td>
                                    <td className="border-t">
                                        <Link href={delete_url} method="delete" as="button" className="hover:text-red-600">Delete</Link>
                                    </td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>
                <Pagination links={links} />
            <Link href={create_url} as="button" className="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add Room to Property</Link>
            <Link href={route('property.index')} as="button" className="ml-2 border border-gray-300 hover:bg-gray-100 rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center">Back</Link>
            </div>

        </>
    )
}
