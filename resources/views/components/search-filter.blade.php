
    <form action="{{route('search.profiles')}}" method="get" class="form-filter">
        <div class="form-group">
            <select name="age" id="" class="form-control px-1">
                <option selected disabled value="0">Edad</option>
                <option value="1">18-25</option>
                <option value="2">25-35</option>
                <option value="3">35-45</option>
                <option value="4">45-55</option>
                <option value="5">+55</option>
            </select>
        </div>
        <div class="form-group">
            <select name="height" id="" class="form-control px-1">
                <option selected disabled value="0">Altura</option>
                <option value="1">150 cm</option>
                <option value="2">160 cm</option>
                <option value="3">170 cm</option>
                <option value="4">180 cm</option>
                <option value="5">190 cm</option>
            </select>
        </div>
        <div class="form-group">
            <select name="genre" id="" class="form-control px-1">
                <option selected disabled value="1">Sexo</option>
                <option value="1">Male</option>
                <option value="0">Female</option>
            </select>
        </div>
        <div class="form-group">
            <select name="weight" id="" class="form-control px-1">
                <option selected disabled value="1">Peso</option>
                <option value="1">40-50 Kg</option>
                <option value="2">51-60 Kg</option>
                <option value="3">61-70 kg</option>
                <option value="4">71-80 Kg</option>
                <option value="5">81-90 Kg</option>
                <option value="5">+ 90 Kg</option>
            </select>
        </div>
        <div class="form-group">
            <select name="breast_size" id="" class="form-control px-1">
                <option selected disabled value="1">Pecho</option>
                <option value="1">Poco</option>
                <option value="2">Medio</option>
                <option value="3">Grande</option>
                <option value="4">XXL</option>

            </select>
        </div>
        {{-- <div class="form-group">
            <select name="breast_size" id="" class="form-control px-1">
                <option selected disabled value="1">Edad</option>
                <option value="1">18-25</option>
                <option value="2">18-25</option>
                <option value="3">18-25</option>
                <option value="4">18-25</option>
                <option value="5">18-25</option>
            </select>
        </div> --}}
        <div class="form-group">
            <button type="submit" class="btn bg-pink text-white btn-submit" >{{ __('general.Search') }}</button>
        </div>
    </form>
