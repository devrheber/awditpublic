<html>
<body>
    <table border=0>
        <tbody> 
            <tr>
                <td>
                    Hello,
                </td>
            </tr>
            <tr>
                <td>
                    I am {{$location->locationcreator->getSupplierFullName()}}. I'm a supplier of your company.
                </td>
            </tr>
            <tr>
                <td>
                    I requesting to you, I'm created new location so please <a href="{{route('client.accept.location',$location->id)}}">Accept</a>  the my location which detail are : 
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                location name 
                            </td>
                            <td>
                                {{ $location->location_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                location country 
                            </td>
                            <td>
                                {{ $location->country->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                location state 
                            </td>
                            <td>
                                {{ $location->state->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                location city 
                            </td>
                            <td>
                                {{ $location->country->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                location category 
                            </td>
                            <td>
                                {{ $location->category->title}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                location size
                            </td>
                            <td>
                                {{ $location->size->value}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                location maturity
                            </td>
                            <td>
                                {{ $location->locationmaturity->level_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                location security
                            </td>
                            <td>
                                @if($location->security == 1 ) Yes @else No @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
