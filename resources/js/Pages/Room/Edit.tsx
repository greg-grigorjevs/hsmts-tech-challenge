import React, { useState } from 'react'

import { Link, router } from '@inertiajs/react'
import { Property, Room } from '@/types'

type Props = {
    room: Room,
    property: Property,
    update_url: string
}

export default function Edit({ room, property, update_url }: Props) {
    const [data, setData] = useState({
        name: room.name || '',
        size: room.size || '',
    })

    function handleChange(e: React.FormEvent<HTMLInputElement>) {
        const key = e.currentTarget.id
        const value = e.currentTarget.value

        setData(data => ({
            ...data,
            [key]: value
        }))
    }

    function handleSubmit(e: React.SyntheticEvent) {
        e.preventDefault()
        router.put(update_url, data)
    }

    return (
        <>
            <div className="p-8 rounded border border-gray-200">
                <h1 className="font-medium text-3xl">Edit Room</h1>
                <form onSubmit={handleSubmit}>
                    <div className="mb-6">
                        <label htmlFor="name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                        <input id="name" onChange={handleChange} value={data.name} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    </div>
                    <div className="mb-6">
                        <label htmlFor="size" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size:</label>
                        <input id="size" type="number" step="0.1" onChange={handleChange} value={data.size} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    </div>

                    <div>
                        <input type="submit" className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" />
                        <Link href={route('room.indexByProperty', property.id)} as="button" className="ml-2 border border-gray-300 hover:bg-gray-100 rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancel</Link>
                    </div>
                </form>
            </div>

        </>

    );
}
