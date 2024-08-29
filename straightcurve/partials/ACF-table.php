<?php 
    $table = get_field('custom_table');
    $custom_table = '';

    if( $table && count( $table['body'] ) > 0 ) {
        $custom_table .= '<div class="table-wrapper"><table>';
        
        if( $table && count( $table['header'] ) > 0 ) {
            $custom_table .= '<tr>';
            foreach($table['header'] as $item) {
                $custom_table .= '<th>' . $item['c'] . '</th>';
            }
            $custom_table .= '</tr>';
        }

        foreach($table['body'] as $items) {
            $custom_table .= '<tr>';
            foreach($items as $item) {
                $custom_table .= '<td>' . $item['c'] . '</td>';
            }
            $custom_table .= '</tr>';
        }
        $custom_table .= '</table></div>';

        echo $custom_table;
    }
?>