import 'dart:convert';

import 'package:flutter/foundation.dart';

class Package {
  String title;
  String description;
  String category;
  double price;
  int vat;
  List<String> benefits;
  Package({
    required this.title,
    required this.description,
    required this.category,
    required this.price,
    required this.vat,
    required this.benefits,
  });

  Package copyWith({
    String? title,
    String? description,
    String? category,
    double? price,
    int? vat,
    List<String>? benefits,
  }) {
    return Package(
      title: title ?? this.title,
      description: description ?? this.description,
      category: category ?? this.category,
      price: price ?? this.price,
      vat: vat ?? this.vat,
      benefits: benefits ?? this.benefits,
    );
  }

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'title': title,
      'description': description,
      'category': category,
      'price': price,
      'vat': vat,
      'benefits': benefits,
    };
  }

  factory Package.fromMap(Map<String, dynamic> map) {
    return Package(
      title: map['title'] as String,
      description: map['description'] as String,
      category: map['category'] as String,
      price: map['price'] as double,
      vat: map['vat'] as int,
      benefits: List<String>.from(
        (map['benefits'] as List<String>),
      ),
    );
  }

  String toJson() => json.encode(toMap());

  factory Package.fromJson(String source) =>
      Package.fromMap(json.decode(source) as Map<String, dynamic>);

  @override
  String toString() {
    return 'Package(title: $title, description: $description, category: $category, price: $price, vat: $vat, benefits: $benefits)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;

    return other is Package &&
        other.title == title &&
        other.description == description &&
        other.category == category &&
        other.price == price &&
        other.vat == vat &&
        listEquals(other.benefits, benefits);
  }

  @override
  int get hashCode {
    return title.hashCode ^
        description.hashCode ^
        category.hashCode ^
        price.hashCode ^
        vat.hashCode ^
        benefits.hashCode;
  }
}
