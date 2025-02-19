CREATE TABLE trn_purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT DEFAULT NULL,
    employee_id INT DEFAULT NULL,
    code VARCHAR(30) DEFAULT NULL,
    date DATE DEFAULT NULL,
    total_item INT(8) DEFAULT NULL,
    total_qty INT(8) DEFAULT NULL,
    total_value DOUBLE(15,2) DEFAULT NULL,
    total_payment DOUBLE(15,2) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    status VARCHAR(100) DEFAULT "NEW",

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_trn_purchases_supplier_id FOREIGN KEY (supplier_id) REFERENCES mst_suppliers(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_purchases_employee_id FOREIGN KEY (employee_id) REFERENCES mst_employees(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_purchases_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_purchases_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE trn_purchase_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_id INT DEFAULT NULL,
    order_number INT DEFAULT NULL,
    item_id INT DEFAULT NULL,
    price DOUBLE(15,2) DEFAULT NULL,
    total_qty INT DEFAULT NULL,
    outgoing_qty INT DEFAULT NULL,
    unit VARCHAR(10) DEFAULT NULL,
    total_price DOUBLE(15,2),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_trn_purchase_items_purchase_id FOREIGN KEY (purchase_id) REFERENCES trn_purchases(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_purchase_items_item_id FOREIGN KEY (item_id) REFERENCES mst_items(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_purchase_items_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_purchase_items_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE trn_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT DEFAULT NULL,
    customer_id INT DEFAULT NULL,
    partner_id INT DEFAULT NULL,
    code VARCHAR(30) DEFAULT NULL,
    date DATE DEFAULT NULL,
    done_date DATE DEFAULT NULL,
    close_date DATE DEFAULT NULL,
    order_type VARCHAR(15) DEFAULT NULL,
    customer_police_number VARCHAR(200) DEFAULT NULL,
    customer_vehicle_type VARCHAR(200) DEFAULT NULL,
    customer_vehicle_color VARCHAR(200) DEFAULT NULL,
    total_item_value DOUBLE(15,2),
    total_service_value DOUBLE(15,2),
    total_value DOUBLE(15,2),
    total_payment DOUBLE(15,2),
    description TEXT DEFAULT NULL,
    pic_url VARCHAR (100) DEFAULT NULL,
    status VARCHAR(100) DEFAULT "NEW",

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,
    
    CONSTRAINT fk_trn_orders_employee_id FOREIGN KEY (employee_id) REFERENCES mst_employees(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_customer_id FOREIGN KEY (customer_id) REFERENCES mst_customers(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_partner_id FOREIGN KEY (partner_id) REFERENCES mst_partners(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE trn_order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT DEFAULT NULL,
    service_id INT DEFAULT NULL,
    order_number INT DEFAULT NULL,
    price DOUBLE(15,2) DEFAULT NULL,
    qty INT(8) DEFAULT NULL,
    unit VARCHAR(10) DEFAULT NULL,
    total_price DOUBLE(15,2) DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,
    
    CONSTRAINT fk_trn_order_items_order_id FOREIGN KEY (order_id) REFERENCES trn_orders(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_service_id FOREIGN KEY (service_id) REFERENCES mst_services(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL

);

CREATE TABLE trn_outgoings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT DEFAULT NULL,
    employee_id INT DEFAULT NULL,
    code VARCHAR(30) DEFAULT NULL,
    date DATE DEFAULT NULL,
    customer_police_number VARCHAR(200) DEFAULT NULL,
    total_value DOUBLE(15,2) DEFAULT NULL,
    total_outgoing_items INT(8) DEFAULT NULL,
    total_outgoing_qty INT(8) DEFAULT NULL,
    total_outgoing_value DOUBLE(15,2) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    status VARCHAR(100) DEFAULT "NEW",

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_trn_outgoings_order_id FOREIGN KEY (order_id) REFERENCES trn_orders(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_outgoings_employee_id FOREIGN KEY (employee_id) REFERENCES mst_employees(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_outgoings_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_outgoings_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE trn_outgoing_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    outgoing_id INT DEFAULT NULL,
    order_number INT DEFAULT NULL,
    item_id INT DEFAULT NULL,
    purchase_id INT DEFAULT NULL,
    price DOUBLE(15,2) DEFAULT NULL,
    outgoing_qty INT DEFAULT NULL,
    unit VARCHAR(10) DEFAULT NULL,
    total_price DOUBLE(15,2),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_trn_outgoing_items_purchase_id FOREIGN KEY (purchase_id) REFERENCES trn_purchases(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_outgoing_items_outgoing_id FOREIGN KEY (outgoing_id) REFERENCES trn_outgoings(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_outgoing_items_item_id FOREIGN KEY (item_id) REFERENCES mst_items(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_outgoing_items_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_outgoing_items_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE trn_cash (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bank_id INT DEFAULT NULL,
    code VARCHAR(30) DEFAULT NULL,
    date DATE DEFAULT NULL,
    cash_group VARCHAR(20) DEFAULT NULL,
    cash_type VARCHAR(20) DEFAULT NULL,
    cash_resource VARCHAR(100) DEFAULT NULL,
    reference_number VARCHAR(30) DEFAULT NULL,
    reference_date DATE DEFAULT NULL,
    reference_name VARCHAR(100) DEFAULT NULL,
    police_number_reference VARCHAR(200) DEFAULT NULL,
    total_value DOUBLE(15,2) DEFAULT NULL,
    total_payment_before DOUBLE(15,2) DEFAULT NULL,
    discount DOUBLE(15,2) DEFAULT NULL,
    cash_total DOUBLE(15,2) DEFAULT NULL,
    total_payment DOUBLE(15,2) DEFAULT NULL,
    status VARCHAR(100) DEFAULT "NEW",
    description TEXT DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_trn_cash_bank_id FOREIGN KEY (bank_id) REFERENCES mst_banks(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_cash_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_cash_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);